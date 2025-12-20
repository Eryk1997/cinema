<?php

namespace App\Modules\User\Application\Messenger\QueryResult\Login;

final readonly class LoginQueryResult
{
    public function __construct(
        public string $token,
        public string $email,
    ) {
    }
}
