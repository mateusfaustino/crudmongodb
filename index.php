<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

require 'connection.php';
require 'template.php';

// Criar uma consulta vazia para buscar todos os documentos
$query = new MongoDB\Driver\Query([]);

// Executar a consulta
try {
    $cursor = $manager->executeQuery($mongoDb . '.sites', $query);
    $sites = $cursor->toArray();
} catch (\Throwable $e) {
    error_log('MongoDB query error: ' . $e->getMessage());
    die('Erro ao buscar dados.');
}

$email = $_SESSION['email'];
render_template('index', compact('sites', 'email'));
?>

