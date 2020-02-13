<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\EventSubscriber;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\EventSubscriber\UpdatePersistSubscriber;
use ConnectHolland\UserBundle\Event\UpdateEvent;
use Doctrine\Common\Util\ClassUtils;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
/**
* Test the update persist subscriber.
*
* @coversDefaultClass \ConnectHolland\UserBundle\EventSubscriber\UpdatePersistSubscriber
*/
class UpdatePersistSubscriberTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(UpdatePersistSubscriber::class, $subject, 'Asserting that the class can be instantiated.');
    }
    /**
     * @covers ::persistEntity
     */
    public function testPersistEntity(): void
    {
        [$subject] = $this->getTestClass();
        $event = $this->createMock(UpdateEvent::class);
        $result = $subject->persistEntity($event);
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
        $registry = $this->createMock(RegistryInterface::class);

        return [new UpdatePersistSubscriber($registry), $registry];
    }
}