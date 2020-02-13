<?php

declare(strict_types=1);

/*
 * This file is part of the user bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\UserBundle\EventSubscriber;

use ConnectHolland\UserBundle\Entity\User;
use ConnectHolland\UserBundle\Entity\UserInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;

final class UserLoginSubscriber implements UserLoginSubscriberInterface
{
    /**
     * @var RegistryInterface
     */
    private $registry;

    public function __construct(RegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    public function onUserLogin(InteractiveLoginEvent $event): void
    {
        /** @var UserInterface $user */
        $user = $event->getAuthenticationToken()->getUser();
        $user->setLastLogin(new \DateTime());

        /** @var EntityManagerInterface $userManager */
        $userManager = $this->registry->getManagerForClass(User::class);
        $userManager->persist($user);
        $userManager->flush();
    }

    /**
     * @return array<string, string>
     */
    public static function getSubscribedEvents()
    {
        return [
            SecurityEvents::INTERACTIVE_LOGIN => 'onUserLogin',
        ];
    }
}
