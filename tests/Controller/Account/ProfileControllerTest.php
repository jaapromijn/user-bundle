<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Controller\Account;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Controller\Account\ProfileController;
use ConnectHolland\UserBundle\Entity\User;
use ConnectHolland\UserBundle\Event\UpdateEvent;
use ConnectHolland\UserBundle\Form\Account\ProfileType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
/**
* Test the profile controller.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Controller\Account\ProfileController
*/
class ProfileControllerTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(ProfileController::class, $subject, 'Asserting that the class can be instantiated.');
    }
    /**
     * @covers ::edit
     */
    public function testEdit(): void
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
        $result = $subject->edit($request, $formFactory);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function getTestClass(): array
    {
        $eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $twig = $this->createMock(Environment::class);

        return [new ProfileController($eventDispatcher, $twig), $eventDispatcher, $twig];
    }
}
