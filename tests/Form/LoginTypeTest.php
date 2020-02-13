<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Form;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Form\LoginType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType as BasePasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
/**
* Test the login type.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Form\LoginType
*/
class LoginTypeTest extends TestCase
{
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


        return [new LoginType()];
    }
}