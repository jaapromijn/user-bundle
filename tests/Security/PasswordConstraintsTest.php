<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Security;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Security\PasswordConstraints;
use Rollerworks\Component\PasswordStrength\Validator\Constraints\P0wnedPassword;
use Rollerworks\Component\PasswordStrength\Validator\Constraints\PasswordStrength;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
/**
* Test the password constraints.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Security\PasswordConstraints
*/
class PasswordConstraintsTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(PasswordConstraints::class, $subject, 'Asserting that the class can be instantiated.');
    }
    /**
     * @covers ::getConstraints
     */
    public function testGetConstraints(): void
    {
        [$subject] = $this->getTestClass();

        $result = $subject->getConstraints();
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function getTestClass(): array
    {
        $passwordRequirements = ['foobar'];

        return [new PasswordConstraints($passwordRequirements)];
    }
}