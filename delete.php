<?php
// delete.php
require 'connection.php';

if (isset($_GET['id'])) {
    $id = new MongoDB\BSON\ObjectId($_GET['id']);

    // Preparar a exclusão
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete(['_id' => $id]);

    // Executar a exclusão
    $manager->executeBulkWrite('catalogosites.sites', $bulk);

    echo "Site deletado com sucesso!";
}
?>