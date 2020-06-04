<?php

namespace AssinaturaEletronica\Tests\Implementacao\Repository\Doctrine;

use AssinaturaEletronica\Implementacao\Repository\Doctrine\DoctrineParChavesRepository;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @group repositories
 */
class ParChavesRepositoryTest extends TestCase
{
    /**
     * @covers AssinaturaEletronica\Implementacao\Repository\Doctrine\DoctrineParChavesRepository
     */
    public function testGetChavePrivada()
    {
        $queryBuilderMock = $this->getMockBuilder(QueryBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods(['select', 'from', 'where', 'setParameter', 'execute', 'fetchColumn'])
            ->getMock();

        $queryBuilderMock->expects($this->once())->method('select')->with('chave_privada')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('from')->with('par_chaves')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('where')->with('no_usuario = :no_usuario')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('setParameter')->with('no_usuario', 'hallison.boaventura')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('execute')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('fetchColumn')->willReturn('pri');

        $connectionMock = $this->getMockBuilder(Connection::class)
            ->disableOriginalConstructor()
            ->setMethods(['createQueryBuilder'])
            ->getMock();

        $connectionMock->expects($this->once())
            ->method('createQueryBuilder')
            ->willReturn($queryBuilderMock);

        $assinaturaRepository = new DoctrineParChavesRepository($connectionMock);
        $actual = $assinaturaRepository->getChavePrivada('hallison.boaventura');

        $this->assertEquals('pri', $actual);
    }

    /**
     * @covers AssinaturaEletronica\Implementacao\Repository\Doctrine\DoctrineParChavesRepository
     */
    public function testGetChavePrivadaInexistente()
    {
        $queryBuilderMock = $this->getMockBuilder(QueryBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods(['select', 'from', 'where', 'setParameter', 'execute', 'fetchColumn'])
            ->getMock();

        $queryBuilderMock->expects($this->once())->method('select')->with('chave_privada')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('from')->with('par_chaves')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('where')->with('no_usuario = :no_usuario')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('setParameter')->with('no_usuario', 'hallison.boaventura')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('execute')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('fetchColumn')->willReturn(false);

        $connectionMock = $this->getMockBuilder(Connection::class)
            ->disableOriginalConstructor()
            ->setMethods(['createQueryBuilder'])
            ->getMock();

        $connectionMock->expects($this->once())
            ->method('createQueryBuilder')
            ->willReturn($queryBuilderMock);

        $assinaturaRepository = new DoctrineParChavesRepository($connectionMock);
        $actual = $assinaturaRepository->getChavePrivada('hallison.boaventura');

        $this->assertNull($actual);
    }

    /**
     * @covers AssinaturaEletronica\Implementacao\Repository\Doctrine\DoctrineParChavesRepository
     */
    public function testGetChavePublica()
    {
        $queryBuilderMock = $this->getMockBuilder(QueryBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods(['select', 'from', 'where', 'setParameter', 'execute', 'fetchColumn'])
            ->getMock();

        $queryBuilderMock->expects($this->once())->method('select')->with('chave_publica')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('from')->with('par_chaves')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('where')->with('no_usuario = :no_usuario')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('setParameter')->with('no_usuario', 'hallison.boaventura')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('execute')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('fetchColumn')->willReturn('pub');

        $connectionMock = $this->getMockBuilder(Connection::class)
            ->disableOriginalConstructor()
            ->setMethods(['createQueryBuilder'])
            ->getMock();

        $connectionMock->expects($this->once())
            ->method('createQueryBuilder')
            ->willReturn($queryBuilderMock);

        $assinaturaRepository = new DoctrineParChavesRepository($connectionMock);
        $actual = $assinaturaRepository->getChavePublica('hallison.boaventura');

        $this->assertEquals('pub', $actual);
    }

    /**
     * @covers AssinaturaEletronica\Implementacao\Repository\Doctrine\DoctrineParChavesRepository
     */
    public function testGetChavePublicaInexistente()
    {
        $queryBuilderMock = $this->getMockBuilder(QueryBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods(['select', 'from', 'where', 'setParameter', 'execute', 'fetchColumn'])
            ->getMock();

        $queryBuilderMock->expects($this->once())->method('select')->with('chave_publica')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('from')->with('par_chaves')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('where')->with('no_usuario = :no_usuario')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('setParameter')->with('no_usuario', 'hallison.boaventura')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('execute')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('fetchColumn')->willReturn(false);

        $connectionMock = $this->getMockBuilder(Connection::class)
            ->disableOriginalConstructor()
            ->setMethods(['createQueryBuilder'])
            ->getMock();

        $connectionMock->expects($this->once())
            ->method('createQueryBuilder')
            ->willReturn($queryBuilderMock);

        $assinaturaRepository = new DoctrineParChavesRepository($connectionMock);
        $actual = $assinaturaRepository->getChavePublica('hallison.boaventura');

        $this->assertNull($actual);
    }

    /**
     * @covers AssinaturaEletronica\Implementacao\Repository\Doctrine\DoctrineParChavesRepository
     */
    public function testSalvarParChaves()
    {
        $queryBuilderMock = $this->getMockBuilder(QueryBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods(['insert', 'setValue', 'setParameter', 'execute'])
            ->getMock();

        $queryBuilderMock->expects($this->once())->method('insert')->with('par_chaves')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->exactly(3))->method('setValue')
            ->withConsecutive(
                ['no_usuario', ':no_usuario'],
                ['chave_privada', ':chave_privada'],
                ['chave_publica', ':chave_publica'],
            )
            ->willReturn($queryBuilderMock);

        $queryBuilderMock->expects($this->exactly(3))->method('setParameter')
            ->withConsecutive(
                ['no_usuario', 'hallison.boaventura'],
                ['chave_privada', 'pri'],
                ['chave_publica', 'pub'],
            )
            ->willReturn($queryBuilderMock);

        $queryBuilderMock->expects($this->once())->method('execute')->willReturn($queryBuilderMock);

        $connectionMock = $this->getMockBuilder(Connection::class)
            ->disableOriginalConstructor()
            ->setMethods(['createQueryBuilder'])
            ->getMock();

        $connectionMock->expects($this->once())
            ->method('createQueryBuilder')
            ->willReturn($queryBuilderMock);

        $assinaturaRepository = new DoctrineParChavesRepository($connectionMock);
        $actual = $assinaturaRepository->salvarParChaves('hallison.boaventura', 'pri', 'pub');

        $this->assertNull($actual);
    }
}
