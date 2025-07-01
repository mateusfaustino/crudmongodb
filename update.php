<?php
// update.php
session_start();
require 'connection.php';
require 'csrf.php';
require 'template.php';
$token = generate_csrf_token();
$message = null;

if (isset($_GET['id'])) {
    $rawId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
    if ($rawId) {
        $id = new MongoDB\BSON\ObjectId($rawId);
    }

    // Localizar o registro a ser editado
    $filter = ['_id' => $id];
    $query = new MongoDB\Driver\Query($filter);
    try {
        $cursor = $manager->executeQuery($mongoDb . '.sites', $query);
        $site = current($cursor->toArray());
    } catch (\Throwable $e) {
        error_log('MongoDB fetch error: ' . $e->getMessage());
        die('Erro ao buscar dados.');
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        die('CSRF validation failed');
    }
    $rawId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_URL);

    if (!$rawId || !$nome || !$endereco) {
        die('Dados do formulário inválidos.');
    }

    $id = new MongoDB\BSON\ObjectId($rawId);

    // Preparar a atualização
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->update(
        ['_id' => $id],
        ['$set' => ['nome' => $nome, 'endereco' => $endereco]]
    );

    // Executar a atualização
    try {
        $manager->executeBulkWrite($mongoDb . '.sites', $bulk);
    } catch (\Throwable $e) {
        error_log('MongoDB update error: ' . $e->getMessage());
        die('Erro ao atualizar dados.');
    }

        // Localizar o registro a ser editado
    $filter = ['_id' => $id];
    $query = new MongoDB\Driver\Query($filter);
    try {
        $cursor = $manager->executeQuery($mongoDb . '.sites', $query);
        $site = current($cursor->toArray());
    } catch (\Throwable $e) {
        error_log('MongoDB fetch error: ' . $e->getMessage());
        die('Erro ao buscar dados.');
    }

    $message = 'Site atualizado com sucesso!';
}

render_template('update', compact('token', 'site', 'message'));

?>

