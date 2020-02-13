<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Message;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Message\Authenticate;
use ApiPlatform\Core\Annotation as Api;
/**
* Test the authenticate.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Message\Authenticate
*/
class AuthenticateTest extends TestCase
{

    public function getTestClass(): array
    {


        return [new Authenticate()];
    }
}