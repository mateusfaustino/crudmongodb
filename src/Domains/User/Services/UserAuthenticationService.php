<?php

namespace Domains\User\Services;

use Domains\User\Repositories\UserRepositoryInterface;

class UserAuthenticationService
{
    private UserRepositoryInterface $repo;

    public function __construct(UserRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function authenticate(string $email, string $senha): bool
    {
        $user = $this->repo->findByEmail($email);

        if ($user && password_verify($senha, $user->getSenha())) {
            $_SESSION['email'] = $user->getEmail();
            return true;
        }

        return false;
    }
}