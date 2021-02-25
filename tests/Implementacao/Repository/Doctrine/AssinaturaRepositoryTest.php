<?php declare(strict_types=1);

namespace AssinaturaEletronica\Tests\Implementacao\Repository\Doctrine;

use AssinaturaEletronica\Implementacao\Repository\Doctrine\DoctrineAssinaturaRepository;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @group repositories
 */
class AssinaturaRepositoryTest extends TestCase
{
    /**
     * @covers AssinaturaEletronica\Implementacao\Repository\Doctrine\DoctrineAssinaturaRepository
     */
    public function testGetAssinatura()
    {
        $queryBuilderMock = $this->getMockBuilder(QueryBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods(['select', 'from', 'where', 'setParameter', 'execute', 'fetchColumn'])
            ->getMock();

        $queryBuilderMock->expects($this->once())->method('select')->with('assinatura')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('from')->with('assinaturas')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('where')->with('recurso_id = :recurso_id')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('setParameter')->with('recurso_id', 'baz_123')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('execute')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('fetchColumn')->willReturn('foo');

        $connectionMock = $this->getMockBuilder(Connection::class)
            ->disableOriginalConstructor()
            ->setMethods(['createQueryBuilder'])
            ->getMock();

        $connectionMock->expects($this->once())
            ->method('createQueryBuilder')
            ->willReturn($queryBuilderMock);

        $assinaturaRepository = new DoctrineAssinaturaRepository($connectionMock);
        $actual = $assinaturaRepository->getAssinatura('baz_123');

        $this->assertEquals('foo', $actual);
    }

    /**
     * @covers AssinaturaEletronica\Implementacao\Repository\Doctrine\DoctrineAssinaturaRepository
     */
    public function testSalvarAssinatura()
    {
        $queryBuilderMock = $this->getMockBuilder(QueryBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods(['insert', 'setValue', 'setParameter', 'execute'])
            ->getMock();

        $queryBuilderMock->expects($this->once())->method('insert')->with('assinaturas')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->exactly(2))->method('setValue')
            ->withConsecutive(
                ['recurso_id', ':recurso_id'],
                ['assinatura', ':assinatura']
            )
            ->willReturn($queryBuilderMock);

        $queryBuilderMock->expects($this->exactly(2))->method('setParameter')
            ->withConsecutive(
                ['recurso_id', 'baz_123'],
                ['assinatura', 'foobar']
            )
            ->willReturn($queryBuilderMock);

        $queryBuilderMock->expects($this->once())->method('execute');

        $connectionMock = $this->getMockBuilder(Connection::class)
            ->disableOriginalConstructor()
            ->setMethods(['createQueryBuilder'])
            ->getMock();

        $connectionMock->expects($this->once())
            ->method('createQueryBuilder')
            ->willReturn($queryBuilderMock);

        $assinaturaRepository = new DoctrineAssinaturaRepository($connectionMock);
        $assinaturaRepository->salvarAssinatura('baz_123', 'foobar');
    }

    /**
     * @covers AssinaturaEletronica\Implementacao\Repository\Doctrine\DoctrineAssinaturaRepository
     */
    public function testGetAssinaturaVazia()
    {
        $queryBuilderMock = $this->getMockBuilder(QueryBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods(['select', 'from', 'where', 'setParameter', 'execute', 'fetchColumn'])
            ->getMock();

        $queryBuilderMock->expects($this->once())->method('select')->with('assinatura')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('from')->with('assinaturas')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('where')->with('recurso_id = :recurso_id')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('setParameter')->with('recurso_id', 'baz_123')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('execute')->willReturn($queryBuilderMock);
        $queryBuilderMock->expects($this->once())->method('fetchColumn')->willReturn(false);

        $connectionMock = $this->getMockBuilder(Connection::class)
            ->disableOriginalConstructor()
            ->setMethods(['createQueryBuilder'])
            ->getMock();

        $connectionMock->expects($this->once())
            ->method('createQueryBuilder')
            ->willReturn($queryBuilderMock);

        $assinaturaRepository = new DoctrineAssinaturaRepository($connectionMock);
        $actual = $assinaturaRepository->getAssinatura('baz_123');

        $this->assertNull($actual);
    }
}
