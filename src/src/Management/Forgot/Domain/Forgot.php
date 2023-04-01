<?php

namespace Src\Management\Forgot\Domain;

use Src\Management\Forgot\Domain\Exceptions\MailFailedException;
use Src\Shared\Domain\Domain;
use Src\Shared\Domain\Helper\HttpCodeDomainHelper;

final class Forgot extends Domain
{
    public const MAIL_FAILED = 'MAIL_FAILED';
    use HttpCodeDomainHelper;

    function isExeption(?string $exeption): void
    {
        if (!is_null($exeption)) {
            match ($exeption) {
                self::MAIL_FAILED => throw new MailFailedException("Error trying to recover password, try again later", $this->internalError()),
            };
        }
    }
}