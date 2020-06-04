<?php

namespace AssinaturaEletronica\Implementacao\Repository\Doctrine;

use AssinaturaEletronica\Repository\ParChavesRepositoryInterface;
use Doctrine\DBAL\Connection;

class DoctrineParChavesRepository implements ParChavesRepositoryInterface
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getChavePrivada(string $noUsuario): ?string
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $resultStatement = $queryBuilder->select('chave_privada')
            ->from('par_chaves')
            ->where('no_usuario = :no_usuario')
            ->setParameter('no_usuario', $noUsuario)
            ->execute();

        if (false === $chavePrivada = $resultStatement->fetchColumn()) {
            return null;
        }

        return $chavePrivada;
    }

    public function getChavePublica(string $noUsuario): ?string
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $resultStatement = $queryBuilder->select('chave_publica')
            ->from('par_chaves')
            ->where('no_usuario = :no_usuario')
            ->setParameter('no_usuario', $noUsuario)
            ->execute();

        if (false === $chavePublica = $resultStatement->fetchColumn()) {
            return null;
        }

        return $chavePublica;
    }

    public function salvarParChaves(string $noUsuario, string $chavePrivada, string $chavePubica): void
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->insert('par_chaves')
            ->setValue('no_usuario', ':no_usuario')
            ->setValue('chave_privada', ':chave_privada')
            ->setValue('chave_publica', ':chave_publica')
            ->setParameter('no_usuario', $noUsuario)
            ->setParameter('chave_privada', $chavePrivada)
            ->setParameter('chave_publica', $chavePubica)
            ->execute();
    }
}
