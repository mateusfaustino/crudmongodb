<?php
require_once __DIR__ . '/../vendor/autoload.php';
session_start();
require 'connection.php'; // define $manager e $mongoDb
require 'csrf.php';
require 'template.php';

use Domains\User\Repositories\MongoUserRepository;
use Domains\User\Services\UserRegistrationService;

$token = generateCsrfToken();
$mensagem = null;

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    if (!verifyCsrfToken($_POST['csrf_token'] ?? '')) {
        die('CSRF validation failed');
    }

    $nome = trim($_POST['nome'] ?? '');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = $_POST['senha'] ?? null;

    if (!$email || !$senha || empty($nome)) {
        $mensagem = 'Dados de cadastro inválidos!';
    } else {
        try {
            $repo = new MongoUserRepository($manager, $mongoDb);
            $service = new UserRegistrationService($repo);
            $service->register($nome, $email, $senha);
            $mensagem = 'Usuário cadastrado com sucesso!';
        } catch (Throwable $e) {
            echo $e->getMessage();
            die();
            error_log($e->getMessage());
            $mensagem = 'Erro ao cadastrar usuário.';
        }
    }
}

renderTemplate('register', ['token' => $token, 'mensagem' => $mensagem]);