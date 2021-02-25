<?php declare(strict_types=1);

namespace AssinaturaEletronica\Tests\Implementacao\Factory\OpenSSL;

use AssinaturaEletronica\Implementacao\Factory\OpenSSL\OpenSslVerificadorAssinaturaFactory;
use AssinaturaEletronica\VerificadorAssinatura\VerificadorAssinaturaInterface;
use PHPUnit\Framework\TestCase;

class OpenSslVerificadorAssinaturaFactoryTest extends TestCase
{
    /**
     * @covers AssinaturaEletronica\Implementacao\Factory\OpenSSL\OpenSslVerificadorAssinaturaFactory
     * @covers AssinaturaEletronica\Implementacao\VerificadorAssinatura\OpenSSL\VerificadorAssinaturaOpenSslAdapter
     */
    public function testVerificadorAssinatura()
    {
        $chavePublica = <<<CHAVE_PUBLICA
-----BEGIN PUBLIC KEY-----
MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAOoEjCV8aqjRB5t3Wi7oaFebxyYjX/sj
Oi/gBOTwTJmYvdscKhg+69a12JNs0cCE1DPH4Sgj4MrxElP/Q9s+zesCAwEAAQ==
-----END PUBLIC KEY-----
CHAVE_PUBLICA;

        $verificadorAssinaturaFactory = new OpenSslVerificadorAssinaturaFactory();
        $verificadorAssinatura = $verificadorAssinaturaFactory->createVerificadorAssinatura($chavePublica);

        $this->assertInstanceOf(VerificadorAssinaturaInterface::class, $verificadorAssinatura);
    }
}
