<?php
session_start();
require 'connection.php';
require 'csrf.php';
require 'template.php';
$token = generate_csrf_token();
$mensagem = null;

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        die('CSRF validation failed');
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);

    if (!$email || $senha === null) {
        $mensagem = 'Dados de cadastro inválidos!';
    } else {
        $hash = password_hash($senha, PASSWORD_DEFAULT);

        $document = [
            'email' => $email,
            'senha' => $hash
        ];

        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->insert($document);
        try {
            $manager->executeBulkWrite($mongoDb . '.usuarios', $bulk);
        } catch (\Throwable $e) {
            error_log('MongoDB insert error: ' . $e->getMessage());
            die('Erro ao cadastrar usuário.');
        }

        $mensagem = 'Usuário cadastrado com sucesso!';
    }
}

render_template('register', ['token' => $token, 'mensagem' => $mensagem]);

?>

