<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Repository;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Repository\UserRepository;
use ConnectHolland\UserBundle\Entity\UserInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr;
/**
* Test the user repository.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Repository\UserRepository
*/
class UserRepositoryTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(UserRepository::class, $subject, 'Asserting that the class can be instantiated.');
    }
    /**
     * @covers ::findOneByEmail
     */
    public function testFindOneByEmail(): void
    {
        [$subject] = $this->getTestClass();
        $email = 'foobar';
        $result = $subject->findOneByEmail($email);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    /**
     * @covers ::findOneByOAuthUsername
     */
    public function testFindOneByOAuthUsername(): void
    {
        [$subject] = $this->getTestClass();
        $resource = 'foobar';
        $oauthUsername = 'foobar';
        $result = $subject->findOneByOAuthUsername($resource, $oauthUsername);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function getTestClass(): array
    {
        $registry = $this->createMock(ManagerRegistry::class);
        $class = 'foobar';

        return [new UserRepository($registry, $class), $registry];
    }
}