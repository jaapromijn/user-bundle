<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Event;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Event\UpdateEvent;
use Symfony\Component\EventDispatcher\GenericEvent;
/**
* Test the update event.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Event\UpdateEvent
*/
class UpdateEventTest extends TestCase
{

    public function getTestClass(): array
    {
        $subject = 'foo';
        $arguments = ['foobar'];

        return [new UpdateEvent($subject, $arguments)];
    }
}