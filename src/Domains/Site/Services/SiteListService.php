<?php

namespace Domains\Site\Services;

use Domains\Site\Repositories\SiteRepositoryInterface;

class SiteListService
{
    private SiteRepositoryInterface $repository;

    public function __construct(SiteRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function listar(): array
    {
        
        return $this->repository->findAll();
    }
}