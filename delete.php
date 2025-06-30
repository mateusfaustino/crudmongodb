<?php
// delete.php
require 'connection.php';

if (isset($_GET['id'])) {
    $rawId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
    if (!$rawId) {
        die('ID inválido.');
    }
    $id = new MongoDB\BSON\ObjectId($rawId);

    // Preparar a exclusão
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete(['_id' => $id]);

    // Executar a exclusão
    try {
        $manager->executeBulkWrite('catalogosites.sites', $bulk);
    } catch (\Throwable $e) {
        error_log('MongoDB delete error: ' . $e->getMessage());
        die('Erro ao deletar dados.');
    }

    echo "Site deletado com sucesso!";
}
?>