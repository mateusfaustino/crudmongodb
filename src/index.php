<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

require_once '../vendor/autoload.php'; // Autoload via Composer
require 'connection.php'; // define $manager, $mongoDb
require 'template.php';

use Domains\Site\Repositories\MongoSiteRepository;
use Domains\Site\Services\SiteListService;

$repo = new MongoSiteRepository($manager, $mongoDb);
$service = new SiteListService($repo);
$sites = $service->listar();

$email = $_SESSION['email'];

renderTemplate('index', compact('sites', 'email'));