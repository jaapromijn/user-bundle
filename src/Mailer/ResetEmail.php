<?php

declare(strict_types=1);

/*
 * This file is part of the user bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\UserBundle\Mailer;

use ConnectHolland\UserBundle\Entity\UserInterface;
use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Negotiation\NegotiatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\UriSigner;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

final class ResetEmail extends BaseEmail implements ResetEmailInterface
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var UriSigner
     */
    private $uriSigner;

    /**
     * @var NegotiatorInterface
     */
    private $negotiator;

    /**
     * @var Request|null
     */
    private $request;

    public function __construct(RouterInterface $router, UriSigner $uriSigner, NegotiatorInterface $negotiator, RequestStack $requestStack)
    {
        $this->router     = $router;
        $this->uriSigner  = $uriSigner;
        $this->negotiator = $negotiator;
        $this->request    = $requestStack->getCurrentRequest();
    }

    public function send(UserInterface $user): \Swift_Message
    {
        $path = ($this->request !== null && $this->negotiator->getResult($this->request) === 'json') ? 'connectholland_user_reset_confirm.api' : 'connectholland_user_reset_confirm';
        $link = $this->router->generate($path, ['token' => $user->getPasswordRequestToken(), 'email' => $user->getEmail()], UrlGeneratorInterface::ABSOLUTE_URL);

        return $this->mailer->createMessageAndSend(
            'reset',
            $user->getEmail(),
            [
                'user' => $user,
                'link' => $this->uriSigner->sign($link),
            ]
        );
    }
}
