<?php
// create.php
session_start();
require 'connection.php';
require 'csrf.php';
require 'template.php';
$token = generateCsrfToken();
$message = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!verifyCsrfToken($_POST['csrf_token'] ?? '')) {
        die('CSRF validation failed');
    }
    // Capturar dados do formulário com validação
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_URL);

    if (!$nome || !$endereco) {
        die('Dados do formulário inválidos.');
    }

    $document = [
        'nome' => $nome,
        'endereco' => $endereco
    ];
    // Preparar o documento para inserção
    $bulk = new MongoDB\Driver\BulkWrite;

    $bulk->insert($document);

    // Inserir no MongoDB
    try {
        $manager->executeBulkWrite($mongoDb . '.sites', $bulk);
    } catch (\Throwable $e) {
        error_log('MongoDB insert error: ' . $e->getMessage());
        die('Erro ao inserir dados.');
    }

    $message = 'Site cadastrado com sucesso!';
}

renderTemplate('create', ['token' => $token, 'message' => $message]);

?>

