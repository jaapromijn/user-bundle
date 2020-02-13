<?php

declare(strict_types=1);

/*
 * This file is part of the user bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\UserBundle\Mailer;

use League\HTMLToMarkdown\HtmlConverter;
use Symfony\Component\DomCrawler\Crawler;
use Twig\Environment;

final class Mailer implements MailerInterface
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var string
     */
    private $fromEmail;

    /**
     * @var Environment
     */
    private $twig;

    public function __construct(\Swift_Mailer $mailer, string $fromEmail, Environment $twig)
    {
        $this->mailer    = $mailer;
        $this->fromEmail = $fromEmail;
        $this->twig      = $twig;
    }

    public function createMessageAndSend(string $name, $to, array $parameters = []): \Swift_Message
    {
        return $this->doSend($to, $this->createHTMLBody($name, $parameters), $parameters);
    }

    private function createHTMLBody(string $name, array $parameters): string
    {
        $parameters['name'] = isset($parameters['name']) ? $parameters['name'] : $name;

        $html = $this->twig->render(sprintf('@ConnecthollandUser/emails/%s.html.twig', $name), $parameters);

        return $html;
    }

    private function doSend($to, string $body, array $parameters): \Swift_Message
    {
        /** @var \Swift_Message $message */
        $message = $this->mailer->createMessage();

        $crawler = new Crawler($body);
        $message->setSubject($crawler->filter('head > title')->text());
        $message->setFrom($this->fromEmail);
        $message->setTo($to);
        $message->setBody((new HtmlConverter())->convert($crawler->filter('body')->html()));
        $message->addPart($crawler->html(), 'text/html');

        if (isset($parameters['attachment'])) {
            $message->attach($parameters['attachment']);
        }

        $sent = ($this->mailer->send($message) === 1);
        if ($sent === false) {
            throw new \RuntimeException(sprintf('Could not send %s email', $parameters['name']));
        }

        return $message;
    }
}
