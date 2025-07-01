<?php
// read.php
require 'connection.php';

// Criar uma consulta vazia para buscar todos os documentos
$query = new MongoDB\Driver\Query([]);

// Executar a consulta
try {
    $cursor = $manager->executeQuery($mongoDb . '.sites', $query);
} catch (\Throwable $e) {
    error_log('MongoDB query error: ' . $e->getMessage());
    die('Erro ao buscar dados.');
}

// Exibir os resultados
echo "<h2>Lista de Sites</h2>";
foreach ($cursor as $document) {
    echo "ID: " . htmlspecialchars((string) $document->_id, ENT_QUOTES, 'UTF-8') . "<br>";
    echo "Nome: " . htmlspecialchars($document->nome, ENT_QUOTES, 'UTF-8') . "<br>";
    echo "Endereço: " . htmlspecialchars($document->endereco, ENT_QUOTES, 'UTF-8') . "<br>";
    echo "<a href='update.php?id=" . htmlspecialchars((string) $document->_id, ENT_QUOTES, 'UTF-8') . "'>Editar</a> | ";
    echo "<a href='delete.php?id=" . htmlspecialchars((string) $document->_id, ENT_QUOTES, 'UTF-8') . "'>Deletar</a><br><br>";
}
?>