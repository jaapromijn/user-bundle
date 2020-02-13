<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Mailer;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Mailer\ValidateUsernameEmail;
use ConnectHolland\UserBundle\Entity\UserInterface;
use ConnectHolland\UserBundle\Mailer\MailerInterface;
use Symfony\Component\HttpKernel\UriSigner;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
/**
* Test the validate username email.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Mailer\ValidateUsernameEmail
*/
class ValidateUsernameEmailTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(ValidateUsernameEmail::class, $subject, 'Asserting that the class can be instantiated.');
    }
    /**
     * @covers ::send
     */
    public function testSend(): void
    {
        [$subject] = $this->getTestClass();
        $user = $this->createMock(UserInterface::class);
        $result = $subject->send($user);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function getTestClass(): array
    {
        $router = $this->createMock(RouterInterface::class);
        $uriSigner = $this->createMock(UriSigner::class);

        return [new ValidateUsernameEmail($router, $uriSigner), $router, $uriSigner];
    }
}