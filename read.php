<?php
// read.php
require 'connection.php';

// Criar uma consulta vazia para buscar todos os documentos
$query = new MongoDB\Driver\Query([]);

// Executar a consulta
$cursor = $manager->executeQuery('catalogosites.sites', $query);

// Exibir os resultados
echo "<h2>Lista de Sites</h2>";
foreach ($cursor as $document) {
    echo "ID: " . $document->_id . "<br>";
    echo "Nome: " . $document->nome . "<br>";
    echo "Endereço: " . $document->endereco . "<br>";
    echo "<a href='update.php?id=" . $document->_id . "'>Editar</a> | ";
    echo "<a href='delete.php?id=" . $document->_id . "'>Deletar</a><br><br>";
}
?>