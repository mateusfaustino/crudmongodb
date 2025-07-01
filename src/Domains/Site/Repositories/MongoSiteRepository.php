<?php

namespace Domains\Site\Repositories;

use Domains\Site\Models\Site;
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;

class MongoSiteRepository implements SiteRepositoryInterface
{
    private Manager $manager;
    private string $database;

    public function __construct(Manager $manager, string $database)
    {
        $this->manager = $manager;
        $this->database = $database;
    }

    public function findAll(): array
    {
        $query = new Query([]);

        try {
            $cursor = $this->manager->executeQuery($this->database . '.sites', $query);
            $sites = [];

            foreach ($cursor as $item) {
                $sites[] = new Site($item->nome ?? '', $item->endereco ?? '', $item->_id ?? '');
            }
            //  var_dump($sites);
            // die();
            return $sites;
        } catch (\Throwable $e) {
           
            error_log('MongoDB query error: ' . $e->getMessage());
            return [];
        }
    }
}