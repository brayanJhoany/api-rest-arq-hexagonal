<?php

namespace Src\Management\Forgot\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\StringValueObject;
use stdClass;

final class ForgotMailable extends StringValueObject
{
    private stdClass $mailObject;

    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->mailObject = new stdClass();
        $this->setFrom();
        $this->setSubject();
        $this->setMarkdown();
        // $this->mailObject->email = $value;
    }

    public function getObjectMailable(): stdClass
    {
        return $this->mailObject;
    }

    private function setFrom(): void
    {
        $this->mailObject->from = env('MAIL_FROM_ADDRESS');
    }
    private function setSubject(): void
    {
        $this->mailObject->subject = 'Forgot Password';
    }
    private function setMarkdown(): void
    {
        $this->mailObject->markdown = 'Mails.forgot';
    }
}