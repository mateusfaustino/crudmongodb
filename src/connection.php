<?php
$mongoHost = getenv('MONGO_HOST') ?: 'localhost';
$mongoPort = getenv('MONGO_PORT') ?: '27017';
$mongoDb   = getenv('MONGO_DB')   ?: 'catalogosites';
$manager = null;
try {
    $manager = new MongoDB\Driver\Manager("mongodb://{$mongoHost}:{$mongoPort}");
} catch (\Throwable $e) {
    error_log('MongoDB connection error: ' . $e->getMessage());
    die('Falha ao conectar ao banco de dados.');
}