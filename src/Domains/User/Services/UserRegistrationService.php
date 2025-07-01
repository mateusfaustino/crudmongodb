<?php

namespace Domains\User\Services;

use Domains\User\Models\User;
use Domains\User\Repositories\UserRepositoryInterface;

class UserRegistrationService
{
    private UserRepositoryInterface $repo;

    public function __construct(UserRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function register(string $nome, string $email, string $senha): void
    {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $user = new User($nome, $email, $senhaHash);
        $this->repo->save($user);
    }
}