<?php

namespace AssinaturaEletronica\Tests\Implementacao\ParChaves\OpenSSL;

use AssinaturaEletronica\Implementacao\ParChaves\OpenSSL\GeradorParChavesOpenSslAdapter;
use PHPUnit\Framework\TestCase;

class GeradorParChavesOpenSslAdapterTest extends TestCase
{
    /**
     * @covers AssinaturaEletronica\Implementacao\ParChaves\OpenSSL\GeradorParChavesOpenSslAdapter
     */
    public function testGerar()
    {
        $geradorParChaves = new GeradorParChavesOpenSslAdapter(['private_key_bits' => 512]);
        $geradorParChaves->gerar();

        $this->assertStringContainsString('BEGIN PRIVATE KEY', $geradorParChaves->getChavePrivada());
        $this->assertStringContainsString('BEGIN PUBLIC KEY', $geradorParChaves->getChavePublica());
    }

    /**
     * @covers AssinaturaEletronica\Implementacao\ParChaves\OpenSSL\GeradorParChavesOpenSslAdapter
     */
    public function testGerarComConfiguracaoInvalida()
    {
        $geradorParChaves = new GeradorParChavesOpenSslAdapter(['private_key_bits' => 0]);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Falha ao gerar par de chaves.');

        $geradorParChaves->gerar();
    }
}
