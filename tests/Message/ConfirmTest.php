<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Message;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Message\Confirm;
use ApiPlatform\Core\Annotation\ApiResource;
/**
* Test the confirm.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Message\Confirm
*/
class ConfirmTest extends TestCase
{

    public function getTestClass(): array
    {


        return [new Confirm()];
    }
}