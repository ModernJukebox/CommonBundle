<?php

namespace ModernJukebox\Bundle\Common\Tests\Fixtures;

class SendEmailRequest
{
    private string $subject;

    public function __construct(string $subject)
    {
        $this->subject = $subject;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }
}
