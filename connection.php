<?php
$mongoHost = getenv('MONGO_HOST') ?: 'mongo';
$mongoPort = getenv('MONGO_PORT') ?: '27017';
$manager = new MongoDB\Driver\Manager("mongodb://{$mongoHost}:{$mongoPort}");

