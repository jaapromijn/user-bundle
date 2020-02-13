<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Event;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Event\UsernameUpdatedEvent;
use Symfony\Component\EventDispatcher\GenericEvent;
/**
* Test the username updated event.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Event\UsernameUpdatedEvent
*/
class UsernameUpdatedEventTest extends TestCase
{

    public function getTestClass(): array
    {
        $subject = 'foo';
        $arguments = ['foobar'];

        return [new UsernameUpdatedEvent($subject, $arguments)];
    }
}