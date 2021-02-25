<?php declare(strict_types=1);

namespace AssinaturaEletronica\Tests\Implementacao\Objeto\Edocs;

use AssinaturaEletronica\Implementacao\Objeto\Edocs\ObjetoDespachoEdocs;
use PHPUnit\Framework\TestCase;

class ObjetoDespachoEdocsTest extends TestCase
{
    /**
     * @covers AssinaturaEletronica\Implementacao\Objeto\Edocs\ObjetoDespachoEdocs
     */
    public function testGetId()
    {
        $objeto = new ObjetoDespachoEdocs(1, 'foo');

        $this->assertEquals('despacho_1', $objeto->getId());
    }

    /**
     * @covers AssinaturaEletronica\Implementacao\Objeto\Edocs\ObjetoDespachoEdocs
     */
    public function testGetData()
    {
        $objeto = new ObjetoDespachoEdocs(1, 'foo');

        $this->assertEquals('foo', $objeto->getData());
    }
}
