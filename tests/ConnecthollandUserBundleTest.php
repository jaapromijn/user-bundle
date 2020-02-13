<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\ConnecthollandUserBundle;
use ConnectHolland\UserBundle\DependencyInjection\Compiler\PasswordRequirementsInjectorPass;
use ConnectHolland\UserBundle\DependencyInjection\Compiler\ResolveTargetEntityPass;
use ConnectHolland\UserBundle\DependencyInjection\Compiler\ResourceOwnerMapsPass;
use ConnectHolland\UserBundle\DependencyInjection\Compiler\UserClassInjectorPass;
use Symfony\Component\Console\Application;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
/**
* Test the connectholland user bundle.
*
* @coversDefaultClass \ConnectHolland\UserBundle\ConnecthollandUserBundle
*/
class ConnecthollandUserBundleTest extends TestCase
{
    /**
     * @covers ::build
     */
    public function testBuild(): void
    {
        [$subject] = $this->getTestClass();
        $container = $this->createMock(ContainerBuilder::class);
        $subject->build($container);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function getTestClass(): array
    {


        return [new ConnecthollandUserBundle()];
    }
}