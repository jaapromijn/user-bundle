<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\DependencyInjection;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\DependencyInjection\ConnecthollandUserExtension;
use ConnectHolland\UserBundle\Message\Authenticate;
use HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\AbstractResourceOwner;
use HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\GenericOAuth2ResourceOwner;
use HaydenPierce\ClassFinder\ClassFinder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
/**
* Test the connectholland user extension.
*
* @coversDefaultClass \ConnectHolland\UserBundle\DependencyInjection\ConnecthollandUserExtension
*/
class ConnecthollandUserExtensionTest extends TestCase
{
    /**
     * @covers ::load
     */
    public function testLoad(): void
    {
        [$subject] = $this->getTestClass();
        $configs = ['foobar'];
        $container = $this->createMock(ContainerBuilder::class);

        $container
            ->expects($this->once())
            ->method('getExtensionConfig')
            ->willReturn([])
        ;
        $subject->load($configs, $container);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    /**
     * @covers ::prepend
     */
    public function testPrepend(): void
    {
        [$subject] = $this->getTestClass();
        $container = $this->createMock(ContainerBuilder::class);
        $container
            ->expects($this->once())
            ->method('getExtensionConfig')
            ->willReturn([])
        ;
        $subject->prepend($container);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function getTestClass(): array
    {


        return [new ConnecthollandUserExtension()];
    }
}
