<?php
// Verifica se a extensão MongoDB está carregada
if (!extension_loaded("mongodb")) {
    die("A extensão MongoDB não está instalada.");
} else {
    echo("Driver Instalado!!!!!");
}
/*
// Conectando ao MongoDB
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// Consulta para selecionar os documentos da coleção 'sites' no banco 'banco'
$query = new MongoDB\Driver\Query([]);  // Consulta vazia para buscar todos os documentos
try {
    $cursor = $manager->executeQuery('catalogosites.sites', $query);
} catch (\Throwable $e) {
    error_log('MongoDB query error: ' . $e->getMessage());
    die('Erro ao executar consulta.');
}

// Exibir os resultados
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Nome</th><th>Endereço</th></tr>";

foreach ($cursor as $document) {
    // Converter o BSON para array e exibir os dados
    $site = (array) $document;
    echo "<tr><td>" . $site['_id'] . "</td><td>" . $site['nome'] . "</td><td>" . $site['endereco'] . "</td></tr>";
}

echo "</table>";
*/
?>
