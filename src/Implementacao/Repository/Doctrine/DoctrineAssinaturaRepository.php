<?php

namespace AssinaturaEletronica\Implementacao\Repository\Doctrine;

use AssinaturaEletronica\Repository\AssinaturaRepositoryInterface;
use Doctrine\DBAL\Connection;

class DoctrineAssinaturaRepository implements AssinaturaRepositoryInterface
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getAssinatura(string $recursoId): ?string
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $resultStatement = $queryBuilder->select('assinatura')
            ->from('assinaturas')
            ->where('recurso_id = :recurso_id')
            ->setParameter('recurso_id', $recursoId)
            ->execute();

        if (false === $assinatura = $resultStatement->fetchColumn()) {
            return null;
        }

        return $assinatura;
    }

    public function salvarAssinatura(string $recursoId, string $assinatura): void
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->insert('assinaturas')
            ->setValue('recurso_id', ':recurso_id')
            ->setValue('assinatura', ':assinatura')
            ->setParameter('recurso_id', $recursoId)
            ->setParameter('assinatura', $assinatura)
            ->execute();
    }
}
