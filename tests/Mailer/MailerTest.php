<?php
declare(strict_types=1);
/*
* This file is part of the Match Bundle package.
* (c) Connect Holland.
*/
namespace ConnectHolland\UserBundle\Tests\Mailer;
use PHPUnit\Framework\TestCase;
use ConnectHolland\UserBundle\Mailer\Mailer;
use League\HTMLToMarkdown\HtmlConverter;
use Swift_Mailer;
use Symfony\Component\DomCrawler\Crawler;
use Twig\Environment;
/**
* Test the mailer.
*
* @coversDefaultClass \ConnectHolland\UserBundle\Mailer\Mailer
*/
class MailerTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(Mailer::class, $subject, 'Asserting that the class can be instantiated.');
    }
    /**
     * @covers ::createMessageAndSend
     */
    public function testCreateMessageAndSend(): void
    {
        [$subject] = $this->getTestClass();
        $name = 'foobar';
        $to = 'foo';
        $parameters = ['foobar'];
        $result = $subject->createMessageAndSend($name, $to, $parameters);
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function getTestClass(): array
    {
        $mailer = $this->createMock(Swift_Mailer::class);
        $fromEmail = 'foobar';
        $twig = $this->createMock(Environment::class);

        return [new Mailer($mailer, $fromEmail, $twig), $mailer, $twig];
    }
}