<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\EventSubscriber\Doctrine;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\EventSubscriber\Doctrine\OwnableSubscriber;
use ConnectHolland\UserBundle\Entity\UserInterface;
use ConnectHolland\UserBundle\Security\Ownable;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
/**
* Test the ownable subscriber.
*
* @coversDefaultClass \ConnectHolland\UserBundle\EventSubscriber\Doctrine\OwnableSubscriber
*/
class OwnableSubscriberTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(OwnableSubscriber::class, $subject, 'Asserting that the class can be instantiated.');
    }
    /**
     * @covers ::preUpdate
     */
    public function testPreUpdate(): void
    {
        [$subject] = $this->getTestClass();
        $args = $this->createMock(LifecycleEventArgs::class);
        $result = $subject->preUpdate($args);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    /**
     * @covers ::prePersist
     */
    public function testPrePersist(): void
    {
        [$subject] = $this->getTestClass();
        $args = $this->createMock(LifecycleEventArgs::class);
        $result = $subject->prePersist($args);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    /**
     * @covers ::getSubscribedEvents
     */
    public function testGetSubscribedEvents(): void
    {
        [$subject] = $this->getTestClass();

        $result = $subject->getSubscribedEvents();
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function getTestClass(): array
    {
        $tokenStorage = $this->createMock(TokenStorageInterface::class);

        return [new OwnableSubscriber($tokenStorage), $tokenStorage];
    }
}