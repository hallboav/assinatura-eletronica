<?php declare(strict_types=1);

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Table;

function createAssinaturasTableIfNotExists(Connection $connection, int $columnAssinaturaLength): void
{
    $schemaManager = $connection->getSchemaManager();
    if ($schemaManager->tablesExist('assinaturas')) {
        return;
    }

    $assinaturas = new Table('assinaturas');
    $assinaturas->addColumn('id', 'integer', ['unsigned' => true, 'autoincrement' => true, 'notnull' => true]);
    $assinaturas->setPrimaryKey(['id'], 'primary_key_id');
    $assinaturas->addColumn('recurso_id', 'string', ['length' => 64, 'notnull' => true]);
    $assinaturas->addColumn('assinatura', 'binary', ['length' => $columnAssinaturaLength, 'fixed' => true, 'notnull' => true]);
    $assinaturas->addUniqueIndex(['recurso_id', 'assinatura']);
    $schemaManager->createTable($assinaturas);
}

function createChavesPrivadasTableIfNotExists(Connection $connection): void
{
    $schemaManager = $connection->getSchemaManager();
    if ($schemaManager->tablesExist('par_chaves')) {
        return;
    }

    $chavesPrivadas = new Table('par_chaves');
    $chavesPrivadas->addColumn('id', 'integer', ['unsigned' => true, 'autoincrement' => true, 'notnull' => true]);
    $chavesPrivadas->setPrimaryKey(['id'], 'primary_key_id');
    $chavesPrivadas->addColumn('no_usuario', 'string', ['length' => 96, 'notnull' => true]);
    $chavesPrivadas->addColumn('chave_privada', 'text', ['notnull' => true]);
    $chavesPrivadas->addColumn('chave_publica', 'text', ['notnull' => true]);
    $chavesPrivadas->addUniqueIndex(['no_usuario']);
    $schemaManager->createTable($chavesPrivadas);
}
