<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Security;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Security\UserBundleAuthenticator;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
/**
* Test the user bundle authenticator.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Security\UserBundleAuthenticator
*/
class UserBundleAuthenticatorTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(UserBundleAuthenticator::class, $subject, 'Asserting that the class can be instantiated.');
    }
    /**
     * @covers ::supports
     */
    public function testSupports(): void
    {
        [$subject] = $this->getTestClass();
        $request = $this->createMock(Request::class);
        $subject->supports($request);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    /**
     * @covers ::checkCredentials
     */
    public function testCheckCredentials(): void
    {
        [$subject] = $this->getTestClass();
        $credentials = 'foo';
        $user = $this->createMock(UserInterface::class);
        $subject->checkCredentials($credentials, $user);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    /**
     * @covers ::onAuthenticationSuccess
     */
    public function testOnAuthenticationSuccess(): void
    {
        [$subject] = $this->getTestClass();
        $request = $this->createMock(Request::class);
        $token = $this->createMock(TokenInterface::class);
        $providerKey = 'foo';
        $subject->onAuthenticationSuccess($request, $token, $providerKey);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    /**
     * @covers ::getCredentials
     */
    public function testGetCredentials(): void
    {
        [$subject] = $this->getTestClass();
        $request = $this->createMock(Request::class);
        $subject->getCredentials($request);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    /**
     * @covers ::getUser
     */
    public function testGetUser(): void
    {
        [$subject] = $this->getTestClass();
        $credentials = 'foo';
        $userProvider = $this->createMock(UserProviderInterface::class);
        $subject->getUser($credentials, $userProvider);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function getTestClass(): array
    {
        $registry = $this->createMock(RegistryInterface::class);
        $urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $csrfTokenManager = $this->createMock(CsrfTokenManagerInterface::class);
        $passwordEncoder = $this->createMock(UserPasswordEncoderInterface::class);

        return [new UserBundleAuthenticator($registry, $urlGenerator, $csrfTokenManager, $passwordEncoder), $registry, $urlGenerator, $csrfTokenManager, $passwordEncoder];
    }
}