<?php declare(strict_types=1);

namespace AssinaturaEletronica\Tests\Implementacao\Factory\OpenSSL;

use AssinaturaEletronica\Implementacao\Factory\OpenSSL\OpenSslAssinadorFactory;
use AssinaturaEletronica\Assinador\AssinadorInterface;
use PHPUnit\Framework\TestCase;

class OpenSslAssinadorFactoryTest extends TestCase
{
    /**
     * @covers AssinaturaEletronica\Implementacao\Assinador\OpenSSL\AssinadorOpenSslAdapter
     * @covers AssinaturaEletronica\Implementacao\Factory\OpenSSL\OpenSslAssinadorFactory
     */
    public function testCreateAssinador()
    {
        $chavePrivada = <<<CHAVE_PRIVADA
-----BEGIN PRIVATE KEY-----
MIIBVAIBADANBgkqhkiG9w0BAQEFAASCAT4wggE6AgEAAkEA6gSMJXxqqNEHm3da
LuhoV5vHJiNf+yM6L+AE5PBMmZi92xwqGD7r1rXYk2zRwITUM8fhKCPgyvESU/9D
2z7N6wIDAQABAkEAmKPMseq8O07UknBAD5ah8Hr4ZATw5wMsQevx5U5j+E5sE+M8
iZHR1oSyHYTGrm5FUOY29e5Ydpa8OsUTotf0CQIhAP0x2JkBD8gz1rCMgqG2tOWO
BMdGdKinbFxasYX/ZBz1AiEA7JxO9fQtizQEaI3iIbGwPcypZHC5KgkjCrSNIT3+
c18CIEMSfk9h4Z1mZhwUzNIsBVW+PnPPrT20RFdeyyI1Gn81AiA5UGekFmDN3mzO
8sd7B/K8FY5WwSNpNkthtXiWO9EeGwIgIXhLa9pLrbFOwuWJ9D1HOzcYU2m05rOg
pKwPrFqcWxc=
-----END PRIVATE KEY-----
CHAVE_PRIVADA;

        $assinadorFactory = new OpenSslAssinadorFactory();
        $assinador = $assinadorFactory->createAssinador($chavePrivada);

        $this->assertInstanceOf(AssinadorInterface::class, $assinador);
    }
}
