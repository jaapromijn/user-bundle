<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Controller;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\Form\FormInterface;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Controller\ResetController;
use ConnectHolland\UserBundle\Entity\User;
use ConnectHolland\UserBundle\Entity\UserInterface;
use ConnectHolland\UserBundle\Event\AuthenticateUserEvent;
use ConnectHolland\UserBundle\Event\PasswordResetFailedEvent;
use ConnectHolland\UserBundle\Event\PostPasswordResetEvent;
use ConnectHolland\UserBundle\Event\ResetUserEvent;
use ConnectHolland\UserBundle\Event\UserResetEvent;
use ConnectHolland\UserBundle\Form\NewPasswordType;
use ConnectHolland\UserBundle\Form\ResetType;
use ConnectHolland\UserBundle\UserBundleEvents;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\UriSigner;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Twig\Environment;
/**
* Test the reset controller.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Controller\ResetController
*/
class ResetControllerTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(ResetController::class, $subject, 'Asserting that the class can be instantiated.');
    }
    /**
     * @covers ::reset
     */
    public function testReset(): void
    {
        [$subject] = $this->getTestClass();
        $request = $this->createMock(Request::class);
        $form = $this->createMock(FormInterface::class);
        $formFactory = $this->createMock(FormFactoryInterface::class);
        $formFactory
            ->expects($this->any())
            ->method('create')
            ->willReturn($form)
        ;
        $result = $subject->reset($request, $formFactory);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    /**
     * @covers ::resetPassword
     */
    public function testResetPassword(): void
    {
        [$subject, $registry, $session, $eventDispatcher, $router, $twig] = $this->getTestClass();
        $request = $this->createMock(Request::class);
        $email = 'foobar';
        $token = 'foobar';
        $manager = $this->createMock(ObjectRepository::class);
        $formFactory = $this->createMock(FormFactoryInterface::class);
        $encoder = $this->createMock(UserPasswordEncoderInterface::class);
        $uriSigner = $this->createMock(UriSigner::class);
        $html = 'foobarcorge';
        $registry
            ->expects($this->once())
            ->method('getRepository')
            ->willReturn($manager)
        ;
        $router
            ->expects($this->once())
            ->method('generate')
            ->willReturn('/test-reset')
        ;

        $twig
            ->expects($this->once())
            ->method('render')
            ->willReturn($html)
        ;

        $response = $subject->resetPassword($request, $email, $token, $formFactory, $encoder, $uriSigner);

        $this->assertInstanceOf(RedirectResponse::class, $response, 'Asserting that the account action returns a response.');
        $this->assertEquals('/test-reset', $response->getTargetUrl(), 'Asserting that the response contains the right redirect url.');
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function getTestClass(): array
    {
        $registry = $this->createMock(RegistryInterface::class);
        $session = $this->createMock(Session::class);
        $eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $router = $this->createMock(RouterInterface::class);
        $twig = $this->createMock(Environment::class);

        return [new ResetController($registry, $session, $eventDispatcher, $router, $twig), $registry, $session, $eventDispatcher, $router, $twig];
    }
}
