<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\ArgumentResolver;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\ArgumentResolver\FormValueResolver;
use Generator;
use ReflectionClass;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
/**
* Test the form value resolver.
*
* @coversDefaultClass \ConnectHolland\UserBundle\ArgumentResolver\FormValueResolver
*/
class FormValueResolverTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(FormValueResolver::class, $subject, 'Asserting that the class can be instantiated.');
    }
    /**
     * @covers ::supports
     */
    public function testSupports(): void
    {
        [$subject] = $this->getTestClass();
        $request = $this->createMock(Request::class);
        $argument = $this->createMock(ArgumentMetadata::class);
        $result = $subject->supports($request, $argument);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    /**
     * @covers ::resolve
     */
    public function testResolve(): void
    {
        [$subject] = $this->getTestClass();
        $request = $this->createMock(Request::class);
        $argument = $this->createMock(ArgumentMetadata::class);
        $result = $subject->resolve($request, $argument);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function getTestClass(): array
    {
        $formFactory = $this->createMock(FormFactoryInterface::class);

        return [new FormValueResolver($formFactory), $formFactory];
    }
}