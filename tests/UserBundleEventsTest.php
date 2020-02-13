<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\UserBundleEvents;
use ConnectHolland\UserBundle\Event\AuthenticateUserEvent;
use ConnectHolland\UserBundle\Event\CreateOAuthUserEvent;
use ConnectHolland\UserBundle\Event\CreateUserEvent;
use ConnectHolland\UserBundle\Event\OAuthUserCreatedEvent;
use ConnectHolland\UserBundle\Event\PasswordResetFailedEvent;
use ConnectHolland\UserBundle\Event\PostPasswordResetEvent;
use ConnectHolland\UserBundle\Event\PostRegistrationEvent;
use ConnectHolland\UserBundle\Event\ResetUserEvent;
use ConnectHolland\UserBundle\Event\UserCreatedEvent;
use ConnectHolland\UserBundle\Event\UserNotFoundEvent;
use ConnectHolland\UserBundle\Event\UserResetEvent;
/**
* Test the user bundle events.
*
* @coversDefaultClass \ConnectHolland\UserBundle\UserBundleEvents
*/
class UserBundleEventsTest extends TestCase
{

    public function getTestClass(): array
    {


        return [new UserBundleEvents()];
    }
}