<?php
session_start();
require '../vendor/autoload.php'; // PSR-4 Autoload

require 'connection.php'; // $manager, $mongoDb
require 'csrf.php';
require 'template.php';

use Domains\User\Repositories\MongoUserRepository;
use Domains\User\Services\UserAuthenticationService;

$token = generateCsrfToken();
$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrfToken($_POST['csrf_token'] ?? '')) {
        die('CSRF validation failed');
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = $_POST['senha'] ?? null;

    if (!$email || !$senha) {
        $erro = "Email ou senha inválidos!";
    } else {
        try {
            $repo = new MongoUserRepository($manager, $mongoDb);
            $authService = new UserAuthenticationService($repo);

            if ($authService->authenticate($email, $senha)) {
                header("Location: index.php");
                exit();
            } else {
                $erro = "Email ou senha inválidos!";
            }
        } catch (Throwable $e) {
            error_log($e->getMessage());
            $erro = "Erro ao tentar autenticar.";
        }
    }
}

renderTemplate('login', ['token' => $token, 'erro' => $erro]);