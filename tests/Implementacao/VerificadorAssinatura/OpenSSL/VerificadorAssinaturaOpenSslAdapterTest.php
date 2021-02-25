<?php declare(strict_types=1);

namespace AssinaturaEletronica\Tests\Implementacao\OpenSSL\VerificadorAssinatura;

use AssinaturaEletronica\Implementacao\VerificadorAssinatura\OpenSSL\VerificadorAssinaturaOpenSslAdapter;
use PHPUnit\Framework\TestCase;

/**
 * @group verificador
 */
class VerificadorAssinaturaOpenSslAdapterTest extends TestCase
{
    /**
     * @covers AssinaturaEletronica\Implementacao\VerificadorAssinatura\OpenSSL\VerificadorAssinaturaOpenSslAdapter
     */
    public function testVerificarAssinatura()
    {
        $chavePublica = <<<CHAVE_PUBLICA
-----BEGIN PUBLIC KEY-----
MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAOoEjCV8aqjRB5t3Wi7oaFebxyYjX/sj
Oi/gBOTwTJmYvdscKhg+69a12JNs0cCE1DPH4Sgj4MrxElP/Q9s+zesCAwEAAQ==
-----END PUBLIC KEY-----
CHAVE_PUBLICA;

        $assinatura = hex2bin('5734f1adbb3ae747d76e6b0a9d5a9065039ab3f84ac218db6a842dd44feecd524be4762de9732ce495c31338070533c3c3a0ab4cd663e600384dbe0fd81a4bbf');

        $verificador = new VerificadorAssinaturaOpenSslAdapter($chavePublica);
        $actual = $verificador->verificarAssinatura('foo', $assinatura);

        $this->assertTrue($actual);
    }

    /**
     * @covers AssinaturaEletronica\Implementacao\VerificadorAssinatura\OpenSSL\VerificadorAssinaturaOpenSslAdapter
     */
    public function testVerificarAssinaturaComChavePublicaInvalida()
    {
        $verificador = new VerificadorAssinaturaOpenSslAdapter('foo');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Chave pública inválida.');

        $verificador->verificarAssinatura('data', 'sig');
    }

    /**
     * @covers AssinaturaEletronica\Implementacao\VerificadorAssinatura\OpenSSL\VerificadorAssinaturaOpenSslAdapter
     */
    public function testVerificarAssinaturaComAlgoritmoInvalido()
    {
        $chavePublica = <<<CHAVE_PUBLICA
-----BEGIN PUBLIC KEY-----
MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAOoEjCV8aqjRB5t3Wi7oaFebxyYjX/sj
Oi/gBOTwTJmYvdscKhg+69a12JNs0cCE1DPH4Sgj4MrxElP/Q9s+zesCAwEAAQ==
-----END PUBLIC KEY-----
CHAVE_PUBLICA;

        $verificador = new VerificadorAssinaturaOpenSslAdapter($chavePublica, 'baz');

        $this->expectWarning();
        $this->expectWarningMessage('openssl_verify(): Unknown digest algorithm');

        $verificador->verificarAssinatura('foo', 'sig');
    }
}
