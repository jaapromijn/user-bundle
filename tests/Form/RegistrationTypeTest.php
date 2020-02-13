<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Form;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Form\RegistrationType;
use ConnectHolland\UserBundle\Entity\UserInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\NotBlank;
/**
* Test the registration type.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Form\RegistrationType
*/
class RegistrationTypeTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(RegistrationType::class, $subject, 'Asserting that the class can be instantiated.');
    }
    /**
     * @covers ::buildForm
     */
    public function testBuildForm(): void
    {
        [$subject] = $this->getTestClass();
        $builder = $this->createMock(FormBuilderInterface::class);
        $options = ['foobar'];
        $subject->buildForm($builder, $options);
        $this->markTestIncomplete('This test has not been implemented yet.');
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

    public function getTestClass(): array
    {
        $doctrine = $this->createMock(RegistryInterface::class);

        return [new RegistrationType($doctrine), $doctrine];
    }
}