<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Controller\Account;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Controller\Account\AccountController;
use ConnectHolland\UserBundle\Entity\User;
use ConnectHolland\UserBundle\Event\UpdateEvent;
use ConnectHolland\UserBundle\Event\UsernameUpdatedEvent;
use ConnectHolland\UserBundle\Form\Account\AccountType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use ConnectHolland\UserBundle\Entity\UserInterface;
use Twig\Environment;
/**
* Test the account controller.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Controller\Account\AccountController
*/
class AccountControllerTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(AccountController::class, $subject, 'Asserting that the class can be instantiated.');
    }
    /**
     * @covers ::edit
     */
    public function testEdit(): void
    {
        [$subject] = $this->getTestClass();
        $user = $this->createMock(UserInterface::class);
        $request = $this->createMock(Request::class);
        $form = $this->createMock(FormInterface::class);
        $formFactory = $this->createMock(FormFactoryInterface::class);
        $formFactory
            ->expects($this->any())
            ->method('create')
            ->willReturn($form)
        ;
        $result = $subject->edit($user, $request, $formFactory);
    }

    public function getTestClass(): array
    {
        $encoder = $this->createMock(UserPasswordEncoderInterface::class);
        $eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $twig = $this->createMock(Environment::class);

        return [new AccountController($encoder, $eventDispatcher, $twig), $encoder, $eventDispatcher, $twig];
    }
}
