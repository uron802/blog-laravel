<?php

declare(strict_types=1);

namespace App\Context\Manage\User\Application\UseCase\Create;

use App\Context\Manage\User\Interface\Gateway\Command\RegisterUserCommand;

final class Interactor
{
    public function __construct(
        readonly private RegisterUserCommand $regiserUserCommand
    ) {

    }
    public function execute()
    {

    }
}