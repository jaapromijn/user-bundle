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
use ConnectHolland\UserBundle\Event\PasswordResetFailedEvent;
use ConnectHolland\UserBundle\Event\PostPasswordResetEvent;
use ConnectHolland\UserBundle\Event\ResetUserEvent;
use ConnectHolland\UserBundle\Event\UserResetEvent;
use ConnectHolland\UserBundle\Form\NewPasswordType;
use ConnectHolland\UserBundle\Form\ResetType;
use ConnectHolland\UserBundle\UserBundleEvents;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\UriSigner;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Twig\Environment;

final class ResetController
{
    private const PASSWORD_REQUEST_ACTION = 'reset';
    private const PASSWORD_RESET_ACTION   = 'resetPassword';

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
     * @Route("/wachtwoord-vergeten", name="connectholland_user_reset", methods={"GET", "POST"})
     * @Route("/api/account/password-reset", name="connectholland_user_reset.api", methods={"GET", "POST"})
     */
    public function reset(Request $request, FormFactoryInterface $formFactory): Response
    {
        $form = $formFactory->create(ResetType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $resetUserEvent = new ResetUserEvent($form->get('email')->getData());
            /* @scrutinizer ignore-call */
            $this->eventDispatcher->dispatch(UserBundleEvents::RESET_USER, $resetUserEvent);
            if (/* @scrutinizer ignore-deprecated */ $resetUserEvent->isPropagationStopped() === false) {
                $userResetEvent = new UserResetEvent($resetUserEvent->getEmail());
                /* @scrutinizer ignore-call */
                $this->eventDispatcher->dispatch(UserBundleEvents::USER_RESET, $userResetEvent);
                if (/* @scrutinizer ignore-deprecated */ $userResetEvent->isPropagationStopped() === false) {
                    $postPasswordResetEvent = new PostPasswordResetEvent('notice', self::PASSWORD_REQUEST_ACTION);
                    /* @scrutinizer ignore-call */
                    $this->eventDispatcher->dispatch(UserBundleEvents::PASSWORD_RESET_COMPLETED, $postPasswordResetEvent);

                    $form = $formFactory->create(ResetType::class); // reset input
                }
            }
        }

        return new Response(
            $this->twig->render(
                '@ConnecthollandUser/forms/reset.html.twig',
                [
                    'form' => $form->createView(),
                ]
            )
        );
    }

    /**
     * @Route("/wachtwoord-vergeten/{email}/{token}", name="connectholland_user_reset_confirm", methods={"GET", "POST"})
     * @Route("/api/password-reset-confirm/{email}/{token}", name="connectholland_user_reset_confirm.api", methods={"GET", "POST"})
     */
    public function resetPassword(
        Request $request,
        string $email,
        string $token,
        FormFactoryInterface $formFactory,
        UserPasswordEncoderInterface $encoder,
        UriSigner $uriSigner
    ): Response {
        if ($uriSigner->check(sprintf('%s://%s%s', $request->getScheme(), $request->getHttpHost(), $request->getRequestUri())) === false) {
            $defaultResponse          = new RedirectResponse($this->router->generate('connectholland_user_reset'));
            $passwordResetFailedEvent = new PasswordResetFailedEvent($defaultResponse, 'danger', self::PASSWORD_RESET_ACTION);
            /* @scrutinizer ignore-call */
            $this->eventDispatcher->dispatch(UserBundleEvents::PASSWORD_RESET_FAILED, $passwordResetFailedEvent);

            return $passwordResetFailedEvent->getResponse();
        }

        $user = $this->registry->getRepository(UserInterface::class)->findOneBy(['passwordRequestToken' => $token, 'email' => $email]);
        if ($user instanceof UserInterface === false) {
            $defaultResponse          = new RedirectResponse($this->router->generate('connectholland_user_reset'));
            $passwordResetFailedEvent = new PasswordResetFailedEvent($defaultResponse, 'danger', self::PASSWORD_RESET_ACTION);
            /* @scrutinizer ignore-call */
            $this->eventDispatcher->dispatch(UserBundleEvents::PASSWORD_RESET_FAILED, $passwordResetFailedEvent);

            return $passwordResetFailedEvent->getResponse();
        }

        $form = $formFactory->create(NewPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('password')->getData();
            $password      = $encoder->encodePassword($user, $plainPassword);

            $user->setPassword($password);
            $user->setPasswordRequestToken(null);
            $user->setEnabled(true);

            /** @var EntityManagerInterface $userManager */
            $userManager = $this->registry->getManagerForClass(User::class);
            $userManager->persist($user);
            $userManager->flush();

            $authenticateUserEvent = new AuthenticateUserEvent($user, $request);
            /* @scrutinizer ignore-call */
            $this->eventDispatcher->dispatch(UserBundleEvents::AUTHENTICATE_USER, $authenticateUserEvent);
            if (null !== $authenticateUserEvent->getResponse()) {
                return $authenticateUserEvent->getResponse();
            }
        }

        return new Response(
            $this->twig->render(
                '@ConnecthollandUser/forms/new_password.html.twig',
                [
                    'form' => $form->createView(),
                ]
            )
        );
    }
}
