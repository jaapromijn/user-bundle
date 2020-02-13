<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Command;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Command\UserCreateCommand;
use ConnectHolland\UserBundle\Entity\UserInterface;
use ConnectHolland\UserBundle\Event\CreateUserEvent;
use ConnectHolland\UserBundle\Event\UserCreatedEvent;
use ConnectHolland\UserBundle\UserBundleEvents;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
/**
* Test the user create command.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Command\UserCreateCommand
*/
class UserCreateCommandTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(UserCreateCommand::class, $subject, 'Asserting that the class can be instantiated.');
    }

    public function getTestClass(): array
    {
        $eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $doctrine = $this->createMock(RegistryInterface::class);

        return [new UserCreateCommand($eventDispatcher, $doctrine), $eventDispatcher, $doctrine];
    }
}