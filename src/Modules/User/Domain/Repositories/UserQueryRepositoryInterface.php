<?php

namespace App\Modules\User\Domain\Repositories;

use App\Modules\User\Domain\Entity\User;

interface UserQueryRepositoryInterface
{
    public function findOneByEmail(string $email): ?User;
}
