<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\EventSubscriber;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\EventSubscriber\UserCreatedSubscriber;
use ConnectHolland\UserBundle\Event\UserCreatedEventInterface;
use ConnectHolland\UserBundle\Mailer\RegistrationEmail;
use ConnectHolland\UserBundle\UserBundleEvents;
/**
* Test the user created subscriber.
*
* @coversDefaultClass \ConnectHolland\UserBundle\EventSubscriber\UserCreatedSubscriber
*/
class UserCreatedSubscriberTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(UserCreatedSubscriber::class, $subject, 'Asserting that the class can be instantiated.');
    }
    /**
     * @covers ::onUserCreated
     */
    public function testOnUserCreated(): void
    {
        [$subject] = $this->getTestClass();
        $event = $this->createMock(UserCreatedEventInterface::class);
        $result = $subject->onUserCreated($event);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    /**
     * @covers ::getSubscribedEvents
     */
    public function testGetSubscribedEvents(): void
    {
        [$subject] = $this->getTestClass();

        $subject->getSubscribedEvents();
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function getTestClass(): array
    {
        $email = $this->createMock(RegistrationEmail::class);

        return [new UserCreatedSubscriber($email), $email];
    }
}