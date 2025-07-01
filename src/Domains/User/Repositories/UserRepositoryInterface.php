<?php

namespace Domains\User\Repositories;

use Domains\User\Models\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;
    public function findByEmail(string $email): ?User;
}