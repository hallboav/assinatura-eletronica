<?php

namespace AssinaturaEletronica\Tests\Implementacao\Objeto\Edocs;

use AssinaturaEletronica\Implementacao\Objeto\Edocs\ObjetoDocumentoEdocs;
use PHPUnit\Framework\TestCase;

class ObjetoDocumentoEdocsTest extends TestCase
{
    /**
     * @covers AssinaturaEletronica\Implementacao\Objeto\Edocs\ObjetoDocumentoEdocs
     */
    public function testGetId()
    {
        $objeto = new ObjetoDocumentoEdocs(1, 'foo');

        $this->assertEquals('documento_1', $objeto->getId());
    }

    /**
     * @covers AssinaturaEletronica\Implementacao\Objeto\Edocs\ObjetoDocumentoEdocs
     */
    public function testGetData()
    {
        $objeto = new ObjetoDocumentoEdocs(1, 'foo');

        $this->assertEquals('foo', $objeto->getData());
    }
}
