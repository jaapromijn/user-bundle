<?php

declare(strict_types=1);

/*
 * This file is part of the user bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\UserBundle\EventSubscriber;

use ConnectHolland\UserBundle\Event\UserCreatedEventInterface;
use ConnectHolland\UserBundle\Mailer\RegistrationEmail;
use ConnectHolland\UserBundle\UserBundleEvents;

final class UserCreatedSubscriber implements UserCreatedSubscriberInterface
{
    /**
     * @var RegistrationEmail
     */
    private $email;

    public function __construct(RegistrationEmail $email)
    {
        $this->email = $email;
    }

    public function onUserCreated(UserCreatedEventInterface $event): void
    {
        $user = $event->getUser();
        if ($user->isEnabled() === false) {
            $this->email->send($user);
        }
    }

    /**
     * @return array<string, string>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            UserBundleEvents::USER_CREATED => 'onUserCreated',
        ];
    }
}
