<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Form\Account;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Form\Account\AccountType;
use ConnectHolland\UserBundle\Entity\UserInterface;
use ConnectHolland\UserBundle\Security\PasswordConstraints;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType as BasePasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
/**
* Test the account type.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Form\Account\AccountType
*/
class AccountTypeTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(AccountType::class, $subject, 'Asserting that the class can be instantiated.');
    }
    /**
     * @covers ::buildForm
     */
    public function testBuildForm(): void
    {
        [$subject] = $this->getTestClass();
        $builder = $this->createMock(FormBuilderInterface::class);
        $options = ['foobar'];
        $result = $subject->buildForm($builder, $options);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    /**
     * @covers ::configureOptions
     */
    public function testConfigureOptions(): void
    {
        [$subject] = $this->getTestClass();
        $resolver = $this->createMock(OptionsResolver::class);
        $result = $subject->configureOptions($resolver);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    /**
     * @covers ::getBlockPrefix
     */
    public function testGetBlockPrefix(): void
    {
        [$subject] = $this->getTestClass();

        $result = $subject->getBlockPrefix();
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function getTestClass(): array
    {
        $doctrine = $this->createMock(RegistryInterface::class);
        $passwordConstraints = $this->createMock(PasswordConstraints::class);

        return [new AccountType($doctrine, $passwordConstraints), $doctrine, $passwordConstraints];
    }
}