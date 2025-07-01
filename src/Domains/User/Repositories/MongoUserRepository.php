<?php 
namespace Domains\User\Repositories;

use Domains\User\Models\User;
use MongoDB\Driver\Manager;
use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Query;

class MongoUserRepository implements UserRepositoryInterface
{
    private Manager $manager;
    private string $database;

    public function __construct(Manager $manager, string $database)
    {
        $this->manager = $manager;
        $this->database = $database;
    }

    public function save(User $user): void
    {
        $bulk = new BulkWrite;
        $bulk->insert([
            'nome' => $user->getNome(),
            'email' => $user->getEmail(),
            'senha' => $user->getSenha()
        ]);

        $this->manager->executeBulkWrite($this->database . '.usuarios', $bulk);
    }

    public function findByEmail(string $email): ?User
    {
        $filter = ['email' => $email];
        $query = new Query($filter);

        try {
            $cursor = $this->manager->executeQuery($this->database . '.usuarios', $query);
            $usuario = current($cursor->toArray());

            if ($usuario) {
                return new User(
                    $usuario->nome ?? '',
                    $usuario->email,
                    $usuario->senha
                );
            }
        } catch (\Throwable $e) {
            error_log('MongoDB query error: ' . $e->getMessage());
        }

        return null;
    }
}