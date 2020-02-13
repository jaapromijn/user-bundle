<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Routing;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Routing\OAuthRouteLoader;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
/**
* Test the o auth route loader.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Routing\OAuthRouteLoader
*/
class OAuthRouteLoaderTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(OAuthRouteLoader::class, $subject, 'Asserting that the class can be instantiated.');
    }
    /**
     * @covers ::load
     */
    public function testLoad(): void
    {
        [$subject] = $this->getTestClass();
        $resource = 'foo';
        $type = 'foo';
        $result = $subject->load($resource, $type);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    /**
     * @covers ::supports
     */
    public function testSupports(): void
    {
        [$subject] = $this->getTestClass();
        $resource = 'foo';
        $type = 'foo';
        $subject->supports($resource, $type);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function getTestClass(): array
    {
        $resourceOwnerMaps = ['foobar'];

        return [new OAuthRouteLoader($resourceOwnerMaps)];
    }
}