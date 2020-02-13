<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Entity;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Entity\User;
use ConnectHolland\UserBundle\Entity\UserOAuthInterface;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
* Test the user.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Entity\User
*/
class UserTest extends TestCase
{
    /**
     * @covers ::getId
     */
    public function testGetId(): void
    {
        [$subject] = $this->getTestClass();

        $result = $subject->getId();
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function getTestClass(): array
    {


        return [new User()];
    }
}