<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Entity;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Entity\UserOAuth;
use ConnectHolland\UserBundle\Entity\UserInterface;
use Doctrine\ORM\Mapping as ORM;
/**
* Test the user o auth.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Entity\UserOAuth
*/
class UserOAuthTest extends TestCase
{
    /**
     * @covers ::setResource
     * @covers ::getResource
     */
    public function testResourceCanBeSetAndRetrieved(): void
    {
        [$subject] = $this->getTestClass();
        $resource = 'foobar';
        $subject->setResource($resource);

        $this->assertEquals($resource, $subject->getResource(), 'Asserting that the property Resource can be set and retrieved.');
    }
    /**
     * @covers ::setOAuthUsername
     * @covers ::getOAuthUsername
     */
    public function testOAuthUsernameCanBeSetAndRetrieved(): void
    {
        [$subject] = $this->getTestClass();
        $oauthUsername = 'foobar';
        $subject->setOAuthUsername($oauthUsername);

        $this->assertEquals($oauthUsername, $subject->getOAuthUsername(), 'Asserting that the property OAuthUsername can be set and retrieved.');
    }
    /**
     * @covers ::setUser
     * @covers ::getUser
     */
    public function testUserCanBeSetAndRetrieved(): void
    {
        [$subject] = $this->getTestClass();
        $user = $this->createMock(UserInterface::class);
        $subject->setUser($user);

        $this->assertEquals($user, $subject->getUser(), 'Asserting that the property User can be set and retrieved.');
    }

    public function getTestClass(): array
    {


        return [new UserOAuth()];
    }
}