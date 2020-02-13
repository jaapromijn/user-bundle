<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Form;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Form\PasswordType;
use ConnectHolland\UserBundle\Security\PasswordConstraints;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType as BasePasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
/**
* Test the password type.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Form\PasswordType
*/
class PasswordTypeTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(PasswordType::class, $subject, 'Asserting that the class can be instantiated.');
    }
    /**
     * @covers ::configureOptions
     */
    public function testConfigureOptions(): void
    {
        [$subject] = $this->getTestClass();
        $resolver = $this->createMock(OptionsResolver::class);
        $subject->configureOptions($resolver);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    /**
     * @covers ::getParent
     */
    public function testGetParent(): void
    {
        [$subject] = $this->getTestClass();

        $result = $subject->getParent();
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    /**
     * @covers ::getBlockPrefix
     */
    public function testGetBlockPrefix(): void
    {
        [$subject] = $this->getTestClass();

        $subject->getBlockPrefix();
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function getTestClass(): array
    {
        $passwordConstraints = $this->createMock(PasswordConstraints::class);

        return [new PasswordType($passwordConstraints), $passwordConstraints];
    }
}