<?php

namespace AssinaturaEletronica\Tests\Implementacao\AssinaturaEletronica\Edocs;

use AssinaturaEletronica\Assinador\AssinadorInterface;
use AssinaturaEletronica\Implementacao\AssinaturaEletronica\Edocs\AssinadorEletronicoEdocs;
use AssinaturaEletronica\Exception\AssinaturaJaExisteException;
use AssinaturaEletronica\Factory\AbstractAssinadorFactory;
use AssinaturaEletronica\ParChaves\GeradorParChavesInterface;
use AssinaturaEletronica\Repository\AssinaturaRepositoryInterface;
use AssinaturaEletronica\Repository\ParChavesRepositoryInterface;
use PHPUnit\Framework\TestCase;

class AssinadorEletronicoEdocsTest extends TestCase
{
    /**
     * @covers AssinaturaEletronica\Assinador\AssinadorObjeto
     * @covers AssinaturaEletronica\Implementacao\AssinaturaEletronica\Edocs\AssinadorEletronicoEdocs
     * @covers AssinaturaEletronica\Implementacao\Objeto\Edocs\ObjetoDocumentoEdocs
     * @covers AssinaturaEletronica\AssinaturaEletronica\AssinadorEletronico
     */
    public function testAssinarDocumentoComNovoUsuario()
    {
        $assinaturaRepositoryMock = $this->createMock(AssinaturaRepositoryInterface::class);
        $assinaturaRepositoryMock->expects($this->once())->method('getAssinatura')->with('documento_123')->willReturn(null);

        $parChavesRepositoryMock = $this->createMock(ParChavesRepositoryInterface::class);
        $parChavesRepositoryMock->expects($this->once())->method('getChavePrivada')->with('leticia.viegas')->willReturn(null);
        $parChavesRepositoryMock->expects($this->once())->method('salvarParChaves')->with('leticia.viegas', 'pri', 'pub');
        $assinaturaRepositoryMock->expects($this->once())->method('salvarAssinatura')->with('documento_123', 'sig');

        $geradorParChavesMock = $this->createMock(GeradorParChavesInterface::class);
        $geradorParChavesMock->expects($this->once())->method('gerar');
        $geradorParChavesMock->expects($this->once())->method('getChavePrivada')->willReturn('pri');
        $geradorParChavesMock->expects($this->once())->method('getChavePublica')->willReturn('pub');

        $assinadorMock = $this->createMock(AssinadorInterface::class);
        $assinadorMock->expects($this->once())->method('assinar')->with('foo')->willReturn('sig');

        $assinadorFactoryMock = $this->createMock(AbstractAssinadorFactory::class);
        $assinadorFactoryMock->expects($this->once())->method('createAssinador')->with('pri')->willReturn($assinadorMock);

        $assinadorEletronico = new AssinadorEletronicoEdocs(
            $assinaturaRepositoryMock,
            $parChavesRepositoryMock,
            $geradorParChavesMock,
            $assinadorFactoryMock
        );

        $assinaturaRetornada = $assinadorEletronico->assinarDocumento(123, 'foo', 'leticia.viegas');

        $this->assertEquals('sig', $assinaturaRetornada);
    }

    /**
     * @covers AssinaturaEletronica\Implementacao\AssinaturaEletronica\Edocs\AssinadorEletronicoEdocs
     * @covers AssinaturaEletronica\Exception\AssinaturaJaExisteException
     * @covers AssinaturaEletronica\Implementacao\Objeto\Edocs\ObjetoDocumentoEdocs
     * @covers AssinaturaEletronica\AssinaturaEletronica\AssinadorEletronico
     */
    public function testAssinarDocumentoJaAssinado()
    {
        $assinaturaRepositoryMock = $this->getMockBuilder(AssinaturaRepositoryInterface::class)->getMock();
        $assinaturaRepositoryMock->expects($this->once())->method('getAssinatura')->willReturn('sig');

        $parChavesRepositoryMock = $this->getMockBuilder(ParChavesRepositoryInterface::class)->getMock();
        $geradorParChavesMock = $this->createMock(GeradorParChavesInterface::class);
        $assinadorFactoryMock = $this->getMockBuilder(AbstractAssinadorFactory::class)->getMock();

        $this->expectException(AssinaturaJaExisteException::class);
        $this->expectExceptionMessage('Assinatura já existe.');

        $assinadorEletronico = new AssinadorEletronicoEdocs(
            $assinaturaRepositoryMock,
            $parChavesRepositoryMock,
            $geradorParChavesMock,
            $assinadorFactoryMock
        );

        $assinadorEletronico->assinarDocumento(123, 'foo', 'leticia.viegas');
    }

    /**
     * @covers AssinaturaEletronica\Assinador\AssinadorObjeto
     * @covers AssinaturaEletronica\Implementacao\AssinaturaEletronica\Edocs\AssinadorEletronicoEdocs
     * @covers AssinaturaEletronica\Implementacao\Objeto\Edocs\ObjetoDespachoEdocs
     * @covers AssinaturaEletronica\AssinaturaEletronica\AssinadorEletronico
     */
    public function testAssinarDespacho()
    {
        $assinaturaRepositoryMock = $this->createMock(AssinaturaRepositoryInterface::class);
        $assinaturaRepositoryMock->expects($this->once())->method('getAssinatura')->with('despacho_123')->willReturn(null);

        $parChavesRepositoryMock = $this->createMock(ParChavesRepositoryInterface::class);
        $parChavesRepositoryMock->expects($this->once())->method('getChavePrivada')->with('leticia.viegas')->willReturn(null);
        $parChavesRepositoryMock->expects($this->once())->method('salvarParChaves')->with('leticia.viegas', 'pri', 'pub');
        $assinaturaRepositoryMock->expects($this->once())->method('salvarAssinatura')->with('despacho_123', 'sig');

        $geradorParChavesMock = $this->createMock(GeradorParChavesInterface::class);
        $geradorParChavesMock->expects($this->once())->method('gerar');
        $geradorParChavesMock->expects($this->once())->method('getChavePrivada')->willReturn('pri');
        $geradorParChavesMock->expects($this->once())->method('getChavePublica')->willReturn('pub');

        $assinadorMock = $this->createMock(AssinadorInterface::class);
        $assinadorMock->expects($this->once())->method('assinar')->with('foo')->willReturn('sig');

        $assinadorFactoryMock = $this->createMock(AbstractAssinadorFactory::class);
        $assinadorFactoryMock->expects($this->once())->method('createAssinador')->with('pri')->willReturn($assinadorMock);

        $assinadorEletronico = new AssinadorEletronicoEdocs(
            $assinaturaRepositoryMock,
            $parChavesRepositoryMock,
            $geradorParChavesMock,
            $assinadorFactoryMock
        );

        $assinaturaRetornada = $assinadorEletronico->assinarDespacho(123, 'foo', 'leticia.viegas');

        $this->assertEquals('sig', $assinaturaRetornada);
    }
}
