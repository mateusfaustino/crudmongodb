<?php
session_start();
require 'connection.php'; // Conexão com o MongoDB
require 'csrf.php';
require 'template.php';
$token = generate_csrf_token();
$erro = null;

if (isset($_POST['email'])) {


    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        die('CSRF validation failed');
    }
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);

    if (!$email || $senha === null) {
        $erro = "Email ou senha inválidos!";
    } else {
    
    // Criar uma consulta para buscar o usuário pelo email
    $filter = ['email' => $email];
    $query = new MongoDB\Driver\Query($filter);

    // Executar a consulta
    try {
        $cursor = $manager->executeQuery('catalogosites.usuarios', $query); // Usando "catalogosites"
        $usuario = current($cursor->toArray());
    } catch (\Throwable $e) {
        error_log('MongoDB query error: ' . $e->getMessage());
        die('Erro ao buscar usuário.');
    }

    // Verificar se o usuário foi encontrado e se a senha está correta utilizando hash
    if ($usuario && password_verify($senha, $usuario->senha)) {
        // Iniciar a sessão e redirecionar para a página index.php
        $_SESSION['email'] = $usuario->email;
        header("Location: index.php");
        exit();
    } else {
        $erro = "Email ou senha inválidos!";
    }
}}

render_template('login', ['token' => $token, 'erro' => $erro]);

?>