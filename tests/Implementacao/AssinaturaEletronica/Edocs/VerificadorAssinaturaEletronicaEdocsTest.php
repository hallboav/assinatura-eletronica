<?php declare(strict_types=1);

namespace AssinaturaEletronica\Tests\Implementacao\AssinaturaEletronica\Edocs;

use AssinaturaEletronica\Exception\ChavePublicaNaoEncontradaException;
use AssinaturaEletronica\Exception\ObjetoSemAssinaturaException;
use AssinaturaEletronica\Factory\AbstractVerificadorAssinaturaFactory;
use AssinaturaEletronica\Implementacao\AssinaturaEletronica\Edocs\VerificadorAssinaturaEletronicaEdocs;
use AssinaturaEletronica\Repository\AssinaturaRepositoryInterface;
use AssinaturaEletronica\Repository\ParChavesRepositoryInterface;
use AssinaturaEletronica\VerificadorAssinatura\VerificadorAssinaturaInterface;
use PHPUnit\Framework\TestCase;

class VerificadorAssinaturaEletronicaEdocsTest extends TestCase
{
    /**
     * @covers AssinaturaEletronica\Implementacao\AssinaturaEletronica\Edocs\VerificadorAssinaturaEletronicaEdocs
     * @covers AssinaturaEletronica\Implementacao\Objeto\Edocs\ObjetoDocumentoEdocs
     * @covers AssinaturaEletronica\VerificadorAssinatura\VerificadorAssinaturaObjeto
     * @covers AssinaturaEletronica\AssinaturaEletronica\VerificadorAssinaturaEletronica
     */
    public function testVerificarAssinaturaDocumento()
    {
        $assinaturaRepositoryMock = $this->createMock(AssinaturaRepositoryInterface::class);
        $assinaturaRepositoryMock->expects($this->once())->method('getAssinatura')->with('documento_123')->willReturn('sig');

        $parChavesRepositoryMock = $this->createMock(ParChavesRepositoryInterface::class);
        $parChavesRepositoryMock->expects($this->once())->method('getChavePublica')->with('leticia.viegas')->willReturn('pub');

        $verificadorAssinaturaMock = $this->createMock(VerificadorAssinaturaInterface::class);
        $verificadorAssinaturaMock->expects($this->once())->method('verificarAssinatura')->with('foo', 'sig')->willReturn(true);

        $verificadorAssinaturaFactoryMock = $this->createMock(AbstractVerificadorAssinaturaFactory::class);
        $verificadorAssinaturaFactoryMock->expects($this->once())->method('createVerificadorAssinatura')->with('pub')->willReturn($verificadorAssinaturaMock);

        $assinaturaEletronica = new VerificadorAssinaturaEletronicaEdocs(
            $assinaturaRepositoryMock,
            $parChavesRepositoryMock,
            $verificadorAssinaturaFactoryMock
        );

        $actual = $assinaturaEletronica->verificarAssinaturaDocumento(123, 'foo', 'leticia.viegas');

        $this->assertEquals('sig', $actual);
    }

    /**
     * @covers AssinaturaEletronica\Implementacao\AssinaturaEletronica\Edocs\VerificadorAssinaturaEletronicaEdocs
     * @covers AssinaturaEletronica\Exception\ChavePublicaNaoEncontradaException
     * @covers AssinaturaEletronica\Implementacao\Objeto\Edocs\ObjetoDocumentoEdocs
     * @covers AssinaturaEletronica\AssinaturaEletronica\VerificadorAssinaturaEletronica
     */
    public function testVerificarAssinaturaDocumentoComUsuarioSemChavePublica()
    {
        $assinaturaRepositoryMock = $this->createMock(AssinaturaRepositoryInterface::class);

        $parChavesRepositoryMock = $this->createMock(ParChavesRepositoryInterface::class);
        $parChavesRepositoryMock->expects($this->once())->method('getChavePublica')->with('leticia.viegas')->willReturn(null);

        $verificadorAssinaturaFactoryMock = $this->createMock(AbstractVerificadorAssinaturaFactory::class);

        $assinaturaEletronica = new VerificadorAssinaturaEletronicaEdocs(
            $assinaturaRepositoryMock,
            $parChavesRepositoryMock,
            $verificadorAssinaturaFactoryMock
        );

        $this->expectException(ChavePublicaNaoEncontradaException::class);
        $this->expectExceptionMessage('O usuário não possui uma chave pública.');

        $assinaturaEletronica->verificarAssinaturaDocumento(123, 'foo', 'leticia.viegas');
    }

    /**
     * @covers AssinaturaEletronica\Implementacao\AssinaturaEletronica\Edocs\VerificadorAssinaturaEletronicaEdocs
     * @covers AssinaturaEletronica\Exception\ObjetoSemAssinaturaException
     * @covers AssinaturaEletronica\Implementacao\Objeto\Edocs\ObjetoDocumentoEdocs
     * @covers AssinaturaEletronica\AssinaturaEletronica\VerificadorAssinaturaEletronica
     */
    public function testVerificarAssinaturaDocumentoComObjetoSemAssinatura()
    {
        $assinaturaRepositoryMock = $this->createMock(AssinaturaRepositoryInterface::class);
        $assinaturaRepositoryMock->expects($this->once())->method('getAssinatura')->with('documento_123')->willReturn(null);

        $parChavesRepositoryMock = $this->createMock(ParChavesRepositoryInterface::class);
        $parChavesRepositoryMock->expects($this->once())->method('getChavePublica')->with('leticia.viegas')->willReturn('pub');

        $verificadorAssinaturaFactoryMock = $this->createMock(AbstractVerificadorAssinaturaFactory::class);

        $assinaturaEletronica = new VerificadorAssinaturaEletronicaEdocs(
            $assinaturaRepositoryMock,
            $parChavesRepositoryMock,
            $verificadorAssinaturaFactoryMock
        );

        $this->expectException(ObjetoSemAssinaturaException::class);
        $this->expectExceptionMessage('O objeto ainda não foi assinado.');

        $assinaturaEletronica->verificarAssinaturaDocumento(123, 'foo', 'leticia.viegas');
    }

    /**
     * @covers AssinaturaEletronica\Implementacao\AssinaturaEletronica\Edocs\VerificadorAssinaturaEletronicaEdocs
     * @covers AssinaturaEletronica\Implementacao\Objeto\Edocs\ObjetoDocumentoEdocs
     * @covers AssinaturaEletronica\VerificadorAssinatura\VerificadorAssinaturaObjeto
     * @covers AssinaturaEletronica\AssinaturaEletronica\VerificadorAssinaturaEletronica
     */
    public function testVerificarAssinaturaDocumentoInvalida()
    {
        $assinaturaRepositoryMock = $this->createMock(AssinaturaRepositoryInterface::class);
        $assinaturaRepositoryMock->expects($this->once())->method('getAssinatura')->with('documento_123')->willReturn('sig');

        $parChavesRepositoryMock = $this->createMock(ParChavesRepositoryInterface::class);
        $parChavesRepositoryMock->expects($this->once())->method('getChavePublica')->with('leticia.viegas')->willReturn('pub');

        $verificadorAssinaturaMock = $this->createMock(VerificadorAssinaturaInterface::class);
        $verificadorAssinaturaMock->expects($this->once())->method('verificarAssinatura')->with('foo', 'sig')->willReturn(false);

        $verificadorAssinaturaFactoryMock = $this->createMock(AbstractVerificadorAssinaturaFactory::class);
        $verificadorAssinaturaFactoryMock->expects($this->once())->method('createVerificadorAssinatura')->with('pub')->willReturn($verificadorAssinaturaMock);

        $assinaturaEletronica = new VerificadorAssinaturaEletronicaEdocs(
            $assinaturaRepositoryMock,
            $parChavesRepositoryMock,
            $verificadorAssinaturaFactoryMock
        );

        $actual = $assinaturaEletronica->verificarAssinaturaDocumento(123, 'foo', 'leticia.viegas');

        $this->assertNull($actual);
    }

    /**
     * @covers AssinaturaEletronica\Implementacao\AssinaturaEletronica\Edocs\VerificadorAssinaturaEletronicaEdocs
     * @covers AssinaturaEletronica\Implementacao\Objeto\Edocs\ObjetoDespachoEdocs
     * @covers AssinaturaEletronica\VerificadorAssinatura\VerificadorAssinaturaObjeto
     * @covers AssinaturaEletronica\AssinaturaEletronica\VerificadorAssinaturaEletronica
     */
    public function testVerificarAssinaturaDespacho()
    {
        $assinaturaRepositoryMock = $this->createMock(AssinaturaRepositoryInterface::class);
        $assinaturaRepositoryMock->expects($this->once())->method('getAssinatura')->with('despacho_123')->willReturn('sig');

        $parChavesRepositoryMock = $this->createMock(ParChavesRepositoryInterface::class);
        $parChavesRepositoryMock->expects($this->once())->method('getChavePublica')->with('leticia.viegas')->willReturn('pub');

        $verificadorAssinaturaMock = $this->createMock(VerificadorAssinaturaInterface::class);
        $verificadorAssinaturaMock->expects($this->once())->method('verificarAssinatura')->with('foo', 'sig')->willReturn(true);

        $verificadorAssinaturaFactoryMock = $this->createMock(AbstractVerificadorAssinaturaFactory::class);
        $verificadorAssinaturaFactoryMock->expects($this->once())->method('createVerificadorAssinatura')->with('pub')->willReturn($verificadorAssinaturaMock);

        $assinaturaEletronica = new VerificadorAssinaturaEletronicaEdocs(
            $assinaturaRepositoryMock,
            $parChavesRepositoryMock,
            $verificadorAssinaturaFactoryMock
        );

        $actual = $assinaturaEletronica->verificarAssinaturaDespacho(123, 'foo', 'leticia.viegas');

        $this->assertEquals('sig', $actual);
    }
}
