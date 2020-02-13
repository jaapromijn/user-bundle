<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\EventSubscriber;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\EventSubscriber\UserLoginSubscriber;
use ConnectHolland\UserBundle\Entity\User;
use ConnectHolland\UserBundle\Entity\UserInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;
/**
* Test the user login subscriber.
*
* @coversDefaultClass \ConnectHolland\UserBundle\EventSubscriber\UserLoginSubscriber
*/
class UserLoginSubscriberTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(UserLoginSubscriber::class, $subject, 'Asserting that the class can be instantiated.');
    }
    /**
     * @covers ::onUserLogin
     */
    public function testOnUserLogin(): void
    {
        [$subject, $registry] = $this->getTestClass();
        $event = $this->createMock(InteractiveLoginEvent::class);
        $manager = $this->createMock(ObjectManager::class);
        $user = $this->createMock(UserInterface::class);
        $token = $this->createMock(TokenInterface::class);
        $registry
            ->expects($this->once())
            ->method('getManagerForClass')
            ->with(User::class)
            ->willReturn($manager)
        ;
        $event
            ->expects($this->once())
            ->method('getAuthenticationToken')
            ->willReturn($token)
        ;
        $token
            ->expects($this->once())
            ->method('getUser')
            ->willReturn($user)
        ;
        $result = $subject->onUserLogin($event);
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
        $registry = $this->createMock(RegistryInterface::class);

        return [new UserLoginSubscriber($registry), $registry];
    }
}
