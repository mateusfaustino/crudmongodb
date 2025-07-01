<?php

namespace Domains\Site\Repositories;

use Domains\Site\Models\Site;

interface SiteRepositoryInterface
{
    /**
     * @return Site[]
     */
    public function findAll(): array;
}