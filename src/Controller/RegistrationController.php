<?php

declare(strict_types=1);

/*
 * This file is part of the user bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\UserBundle\Controller;

use ConnectHolland\UserBundle\Entity\User;
use ConnectHolland\UserBundle\Entity\UserInterface;
use ConnectHolland\UserBundle\Event\AuthenticateUserEvent;
use ConnectHolland\UserBundle\Event\CreateUserEvent;
use ConnectHolland\UserBundle\Event\PostRegistrationEvent;
use ConnectHolland\UserBundle\Event\UserCreatedEvent;
use ConnectHolland\UserBundle\Event\UserNotFoundEvent;
use ConnectHolland\UserBundle\Repository\UserRepository;
use ConnectHolland\UserBundle\UserBundleEvents;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\UriSigner;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

final class RegistrationController
{
    /**
     * @var RegistryInterface
     */
    private $registry;

    /**
     * @var Session
     */
    private $session;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var Environment
     */
    private $twig;

    public function __construct(RegistryInterface $registry, Session $session, EventDispatcherInterface $eventDispatcher, RouterInterface $router, Environment $twig)
    {
        $this->registry        = $registry;
        $this->session         = $session;
        $this->eventDispatcher = $eventDispatcher;
        $this->router          = $router;
        $this->twig            = $twig;
    }

    /**
     * @Route("/registreren", name="connectholland_user_registration", methods={"GET", "POST"}, defaults={"formName"="ConnectHolland\UserBundle\Form\RegistrationType"})
     * @Route("/api/register", name="connectholland_user_registration.api", methods={"GET", "POST"}, defaults={"formName"="ConnectHolland\UserBundle\Form\RegistrationType"})
     */
    public function register(Request $request, FormInterface $form): Response
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $createUserEvent = new CreateUserEvent($form->getData(), $form->get('plainPassword')->getData());
            /* @scrutinizer ignore-call */
            $this->eventDispatcher->dispatch(UserBundleEvents::CREATE_USER, $createUserEvent);
            if (/* @scrutinizer ignore-deprecated */ $createUserEvent->isPropagationStopped() === false) {
                $userCreatedEvent = new UserCreatedEvent($createUserEvent->getUser());
                /* @scrutinizer ignore-call */
                $this->eventDispatcher->dispatch(UserBundleEvents::USER_CREATED, $userCreatedEvent);
                if (/* @scrutinizer ignore-deprecated */ $userCreatedEvent->isPropagationStopped() === false) {
                    $defaultResponse       = new RedirectResponse($this->router->generate($request->attributes->get('_route')));
                    $postRegistrationEvent = new PostRegistrationEvent('success', $defaultResponse, __FUNCTION__);
                    /* @scrutinizer ignore-call */
                    $this->eventDispatcher->dispatch(UserBundleEvents::REGISTRATION_COMPLETED, $postRegistrationEvent);

                    return $postRegistrationEvent->getResponse();
                }
            }
        }

        $status = ($form->isSubmitted() && !$form->isValid()) ? Response::HTTP_BAD_REQUEST : Response::HTTP_OK;

        return new Response(
            $this->twig->render(
                '@ConnecthollandUser/forms/register.html.twig',
                [
                    'form' => $form->createView(),
                ]
            ),
            $status
        );
    }

    /**
     * @Route("/registreren/bevestigen/{email}/{token}", name="connectholland_user_registration_confirm", methods={"GET", "POST"})
     * @Route("/api/register/confirm/{email}/{token}", name="connectholland_user_registration_confirm.api", methods={"GET", "POST"})
     */
    public function registrationConfirm(Request $request, string $email, string $token, UriSigner $uriSigner): Response
    {
        /** @var UserRepository $userRepository */
        $userRepository = $this->registry->getRepository(UserInterface::class);

        /** @var User|null $user */
        $user = $userRepository->findOneBy(['email' => $email, 'passwordRequestToken' => $token]);

        if (!($user instanceof UserInterface) || $uriSigner->check(sprintf('%s://%s%s', $request->getScheme(), $request->getHttpHost(), $request->getRequestUri())) === false) {
            $defaultResponse   = new RedirectResponse($this->router->generate('connectholland_user_registration'));
            $userNotFoundEvent = new UserNotFoundEvent($defaultResponse, 'danger', __FUNCTION__);
            /* @scrutinizer ignore-call */
            $this->eventDispatcher->dispatch(UserBundleEvents::USER_NOT_FOUND, $userNotFoundEvent);

            return $userNotFoundEvent->getResponse();
        }

        $user->setEnabled(true);
        $user->setPasswordRequestToken(null);

        /** @var EntityManagerInterface $userManager */
        $userManager = $this->registry->getManagerForClass(User::class);
        $userManager->flush();

        $authenticateUserEvent = new AuthenticateUserEvent($user, $request);
        /* @scrutinizer ignore-call */
        $this->eventDispatcher->dispatch(UserBundleEvents::AUTHENTICATE_USER, $authenticateUserEvent);
        if (null !== $authenticateUserEvent->getResponse()) {
            return $authenticateUserEvent->getResponse();
        }

        return new RedirectResponse('/'); // TODO: use a correct redirect route/path to login
    }
}
