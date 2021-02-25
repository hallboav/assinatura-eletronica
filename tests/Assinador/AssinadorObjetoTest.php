<?php declare(strict_types=1);

namespace AssinaturaEletronica\Tests\Assinador;

use AssinaturaEletronica\Assinador\AssinadorInterface;
use AssinaturaEletronica\Assinador\AssinadorObjeto;
use AssinaturaEletronica\Objeto\ObjetoInterface;
use PHPUnit\Framework\TestCase;

/**
 * @group assinador
 */
class AssinadorObjetoTest extends TestCase
{
    /**
     * @covers AssinaturaEletronica\Assinador\AssinadorObjeto
     */
    public function testAssinarObjeto()
    {
        $assinadorMock = $this->createMock(AssinadorInterface::class);
        $assinadorMock->expects($this->once())
            ->method('assinar')
            ->with('foo')
            ->willReturn('bar');

        $objetoMock = $this->createMock(ObjetoInterface::class);
        $objetoMock->expects($this->once())
            ->method('getData')
            ->willReturn('foo');

        $assinadorObjeto = new AssinadorObjeto($assinadorMock);
        $actual = $assinadorObjeto->assinarObjeto($objetoMock);

        $this->assertEquals(
            'bar',
            $actual
        );
    }
}
