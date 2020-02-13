<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Controller;
use Doctrine\Common\Persistence\ObjectRepository;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Controller\RegistrationController;
use ConnectHolland\UserBundle\Entity\User;
use ConnectHolland\UserBundle\Entity\UserInterface;
use ConnectHolland\UserBundle\Event\AuthenticateUserEvent;
use ConnectHolland\UserBundle\Event\CreateUserEvent;
use ConnectHolland\UserBundle\Event\PostRegistrationEvent;
use ConnectHolland\UserBundle\Event\UserCreatedEvent;
use ConnectHolland\UserBundle\Event\UserNotFoundEvent;
use ConnectHolland\UserBundle\Repository\UserRepository;
use ConnectHolland\UserBundle\UserBundleEvents;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\UriSigner;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;
/**
* Test the registration controller.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Controller\RegistrationController
*/
class RegistrationControllerTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(RegistrationController::class, $subject, 'Asserting that the class can be instantiated.');
    }
    /**
     * @covers ::register
     */
    public function testRegister(): void
    {
        [$subject] = $this->getTestClass();
        $request = $this->createMock(Request::class);
        $form = $this->createMock(FormInterface::class);
        $result = $subject->register($request, $form);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    /**
     * @covers ::registrationConfirm
     */
    public function testRegistrationConfirm(): void
    {
        [$subject, $registry, , , $router, $twig] = $this->getTestClass();
        $request = $this->createMock(Request::class);
        $manager = $this->createMock(ObjectRepository::class);
        $email = 'foobar';
        $token = 'foobar';
        $uriSigner = $this->createMock(UriSigner::class);
        $html = 'foobarcorge';

        $router
            ->expects($this->once())
            ->method('generate')
            ->willReturn('/test-registration')
        ;

        $registry
            ->expects($this->once())
            ->method('getRepository')
            ->willReturn($manager)
        ;

        $twig
            ->expects($this->once())
            ->method('render')
            ->willReturn($html)
        ;
        $response = $subject->registrationConfirm($request, $email, $token, $uriSigner);
        $this->assertInstanceOf(RedirectResponse::class, $response, 'Asserting that the account action returns a response.');
        $this->assertEquals('/test-registration', $response->getTargetUrl(), 'Asserting that the response contains the right redirect url.');
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function getTestClass(): array
    {
        $registry = $this->createMock(RegistryInterface::class);
        $session = $this->createMock(Session::class);
        $eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $router = $this->createMock(RouterInterface::class);
        $twig = $this->createMock(Environment::class);

        return [new RegistrationController($registry, $session, $eventDispatcher, $router, $twig), $registry, $session, $eventDispatcher, $router, $twig];
    }
}
