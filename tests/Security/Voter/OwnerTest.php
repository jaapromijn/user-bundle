<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Security\Voter;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Security\Voter\Owner;
use ConnectHolland\UserBundle\Entity\UserInterface;
use ConnectHolland\UserBundle\Security\Ownable;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
/**
* Test the owner.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Security\Voter\Owner
*/
class OwnerTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(Owner::class, $subject, 'Asserting that the class can be instantiated.');
    }

    public function getTestClass(): array
    {
        $decisionManager = $this->createMock(AccessDecisionManagerInterface::class);

        return [new Owner($decisionManager), $decisionManager];
    }
}