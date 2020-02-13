<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Controller;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Controller\SecurityController;
use ConnectHolland\UserBundle\Form\LoginType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;
/**
* Test the security controller.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Controller\SecurityController
*/
class SecurityControllerTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(SecurityController::class, $subject, 'Asserting that the class can be instantiated.');
    }
    /**
     * @covers ::__invoke
     */
    public function test__invoke(): void
    {
        [$subject, $authenticationUtils, $formFactory, $twig] = $this->getTestClass();
        $form = $this->createMock(FormInterface::class);
        $html = 'foobarcorge';
        $formFactory
            ->expects($this->any())
            ->method('create')
            ->willReturn($form)
        ;

        $form
            ->expects($this->any())
            ->method('get')
            ->willReturn($form)
        ;

        $twig
            ->expects($this->once())
            ->method('render')
            ->willReturn($html)
        ;

        $response = $subject->__invoke();
        $this->assertInstanceOf(Response::class, $response, 'Asserting that the account action returns a response.');
        $this->assertStringContainsString($html, $response->getContent(), 'Asserting that the response contains the rendered twig content.');
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function getTestClass(): array
    {
        $authenticationUtils = $this->createMock(AuthenticationUtils::class);
        $form = $this->createMock(FormInterface::class);
        $formFactory = $this->createMock(FormFactoryInterface::class);
        $twig = $this->createMock(Environment::class);

        return [new SecurityController($authenticationUtils, $formFactory, $twig), $authenticationUtils, $formFactory, $twig];
    }
}
