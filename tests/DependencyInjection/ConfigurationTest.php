<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\DependencyInjection;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\DependencyInjection\Configuration;
use ConnectHolland\UserBundle\Entity\User;
use ConnectHolland\UserBundle\Entity\UserInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
/**
* Test the configuration.
*
* @coversDefaultClass \ConnectHolland\UserBundle\DependencyInjection\Configuration
*/
class ConfigurationTest extends TestCase
{
    /**
     * @covers ::getConfigTreeBuilder
     */
    public function testGetConfigTreeBuilder(): void
    {
        [$subject] = $this->getTestClass();

        $subject->getConfigTreeBuilder();
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function getTestClass(): array
    {


        return [new Configuration()];
    }
}