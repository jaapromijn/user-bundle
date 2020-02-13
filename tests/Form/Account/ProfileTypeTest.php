<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Form\Account;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Form\Account\ProfileType;
use ConnectHolland\UserBundle\Entity\UserInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
/**
* Test the profile type.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Form\Account\ProfileType
*/
class ProfileTypeTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(ProfileType::class, $subject, 'Asserting that the class can be instantiated.');
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

        return [new ProfileType($doctrine), $doctrine];
    }
}