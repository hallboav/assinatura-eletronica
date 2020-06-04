<?php

namespace AssinaturaEletronica\Tests\VerificadorAssinatura;

use AssinaturaEletronica\Objeto\ObjetoInterface;
use AssinaturaEletronica\VerificadorAssinatura\VerificadorAssinaturaObjeto;
use AssinaturaEletronica\VerificadorAssinatura\VerificadorAssinaturaInterface;
use PHPUnit\Framework\TestCase;

/**
 * @group verificador
 */
class VerificadorAssinaturaObjetoTest extends TestCase
{
    /**
     * @covers AssinaturaEletronica\VerificadorAssinatura\VerificadorAssinaturaObjeto
     */
    public function testVerificarAssinatura()
    {
        $verificadorAssinaturaMock = $this->createMock(VerificadorAssinaturaInterface::class);
        $verificadorAssinaturaMock->expects($this->once())
            ->method('verificarAssinatura')
            ->with('bar', 'baz')
            ->willReturn(true);

        $objetoMock = $this->createMock(ObjetoInterface::class);
        $objetoMock->expects($this->once())
            ->method('getData')
            ->willReturn('bar');

        $verificadorAssinaturaObjeto = new VerificadorAssinaturaObjeto($verificadorAssinaturaMock);
        $actual = $verificadorAssinaturaObjeto->verificarAssinaturaObjeto($objetoMock, 'baz');

        $this->assertTrue($actual);
    }
}
