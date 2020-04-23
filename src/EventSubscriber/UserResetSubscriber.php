<?php

declare(strict_types=1);

/*
 * This file is part of the user bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\UserBundle\EventSubscriber;

use ConnectHolland\UserBundle\Entity\UserInterface;
use ConnectHolland\UserBundle\Event\UserResetEventInterface;
use ConnectHolland\UserBundle\Mailer\ResetEmailInterface;
use ConnectHolland\UserBundle\UserBundleEvents;
use Doctrine\Common\Persistence\ManagerRegistry;

final class UserResetSubscriber implements UserResetSubscriberInterface
{
    /**
     * @var ResetEmailInterface
     */
    private $email;

    /**
     * @var ManagerRegistry
     */
    private $registry;

    public function __construct(ResetEmailInterface $email, ManagerRegistry $registry)
    {
        $this->email    = $email;
        $this->registry = $registry;
    }

    public function onUserReset(UserResetEventInterface $event): void
    {
        $user = $this->registry->getRepository(UserInterface::class)->findOneBy([
            'email' => $event->getEmail(),
        ]);

        if ($user instanceof UserInterface) {
            $this->email->send($user);
        }
    }

    /**
     * @return array<string, string>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            UserBundleEvents::USER_RESET => 'onUserReset',
        ];
    }
}
