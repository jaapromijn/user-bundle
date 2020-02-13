<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Message;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Message\Reset;
use ApiPlatform\Core\Annotation as Api;
/**
* Test the reset.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Message\Reset
*/
class ResetTest extends TestCase
{

    public function getTestClass(): array
    {


        return [new Reset()];
    }
}