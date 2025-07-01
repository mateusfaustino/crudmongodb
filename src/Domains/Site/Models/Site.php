<?php

// Domains/Site/Models/Site.php
namespace Domains\Site\Models;

class Site
{
    private string $id;
    private string $nome;
    private string $endereco;

    public function __construct(string $nome, string $endereco, string $id)
    {
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->id = $id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getEndereco(): string
    {
        return $this->endereco;
    }
    public function getId(): string
    {
        return $this->id;
    }
}