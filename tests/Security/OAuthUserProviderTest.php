<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Security;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Security\OAuthUserProvider;
use ConnectHolland\UserBundle\Entity\UserInterface;
use ConnectHolland\UserBundle\Entity\UserOAuth;
use ConnectHolland\UserBundle\Event\CreateOAuthUserEvent;
use ConnectHolland\UserBundle\Event\OAuthUserCreatedEvent;
use ConnectHolland\UserBundle\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
/**
* Test the o auth user provider.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Security\OAuthUserProvider
*/
class OAuthUserProviderTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(OAuthUserProvider::class, $subject, 'Asserting that the class can be instantiated.');
    }
    /**
     * @covers ::loadUserByOAuthUserResponse
     */
    public function testLoadUserByOAuthUserResponse(): void
    {
        [$subject] = $this->getTestClass();
        $response = $this->createMock(UserResponseInterface::class);
        $subject->loadUserByOAuthUserResponse($response);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function getTestClass(): array
    {
        $doctrine = $this->createMock(RegistryInterface::class);
        $eventDispatcher = $this->createMock(EventDispatcherInterface::class);

        return [new OAuthUserProvider($doctrine, $eventDispatcher), $doctrine, $eventDispatcher];
    }
}