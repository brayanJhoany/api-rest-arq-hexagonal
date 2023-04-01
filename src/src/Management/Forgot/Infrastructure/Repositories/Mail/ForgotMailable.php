<?php

namespace Src\Management\Forgot\Infrastructure\Repositories\Mail;


use Src\Management\Forgot\Domain\Contracts\ForgotMailableContract;
use Src\Management\Forgot\Domain\Forgot;
use Src\Management\Forgot\Domain\ValueObjects\ForgotMailable as ForgotMailableValueObject;
use Illuminate\Support\Facades\Mail;

class ForgotMailable implements ForgotMailableContract
{
    private Mail $mail;

    public function __construct(Mail $mail)
    {
        $this->mail = $mail;
    }



    public function sendForgotPasswordEmail(ForgotMailableValueObject $forgotMailable): Forgot
    {
        $response = $this->mail::to($forgotMailable->value())
            ->send(new CustomMail($forgotMailable->getObjectMailable()));
        if (!$response) {
            return new Forgot(null, 'MAIL_FAILED');
        }
        return new Forgot([
            'sendTo' => $forgotMailable->value(),
            "message" => "Email sent successfully"
        ]);
    }
}