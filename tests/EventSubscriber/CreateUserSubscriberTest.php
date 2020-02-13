<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\EventSubscriber;
use Doctrine\Common\Persistence\ObjectManager;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\EventSubscriber\CreateUserSubscriber;
use ConnectHolland\UserBundle\Entity\User;
use ConnectHolland\UserBundle\Entity\UserInterface;
use ConnectHolland\UserBundle\Event\CreateUserEventInterface;
use ConnectHolland\UserBundle\UserBundleEvents;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
/**
* Test the create user subscriber.
*
* @coversDefaultClass \ConnectHolland\UserBundle\EventSubscriber\CreateUserSubscriber
*/
class CreateUserSubscriberTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(CreateUserSubscriber::class, $subject, 'Asserting that the class can be instantiated.');
    }
    /**
     * @covers ::onCreateUser
     */
    public function testOnCreateUser(): void
    {
        [$subject, $passwordEncoder, $registry] = $this->getTestClass();
        $event = $this->createMock(CreateUserEventInterface::class);
        $user = $this->createMock(UserInterface::class);
        $manager    = $this->createMock(ObjectManager::class);
        $password = 'c0rg3%g4rply';
        $passwordEncoder
            ->expects($this->any())
            ->method('encodePassword')
            ->with($user, $password)
            ->willReturn(md5($password));
        $event
            ->expects($this->any())
            ->method('getPlainPassword')
            ->willReturn($password);
        $event
            ->expects($this->any())
            ->method('getUser')
            ->willReturn($user);

        $registry
            ->expects($this->once())
            ->method('getManagerForClass')
            ->with(User::class)
            ->willReturn($manager)
        ;
        $result = $subject->onCreateUser($event);
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
        $passwordEncoder = $this->createMock(UserPasswordEncoderInterface::class);
        $registry = $this->createMock(RegistryInterface::class);

        return [new CreateUserSubscriber($passwordEncoder, $registry), $passwordEncoder, $registry];
    }
}
