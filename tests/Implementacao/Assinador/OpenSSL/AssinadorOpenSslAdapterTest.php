<?php declare(strict_types=1);

namespace AssinaturaEletronica\Tests\Implementacao\Assinador\OpenSsl;

use AssinaturaEletronica\Implementacao\Assinador\OpenSSL\AssinadorOpenSslAdapter;
use AssinaturaEletronica\Implementacao\Exception\ChavePrivadaException;
use PHPUnit\Framework\TestCase;

/**
 * @group assinador
 */
class AssinadorOpenSslAdapterTest extends TestCase
{
    /**
     * @covers AssinaturaEletronica\Implementacao\Assinador\OpenSSL\AssinadorOpenSslAdapter
     */
    public function testAssinar()
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

        $assinador = new AssinadorOpenSslAdapter($chavePrivada);
        $actual = $assinador->assinar('foo');
        $actual = bin2hex($actual);

        $this->assertEquals(
            '5734f1adbb3ae747d76e6b0a9d5a9065039ab3f84ac218db6a842dd44feecd524be4762de9732ce495c31338070533c3c3a0ab4cd663e600384dbe0fd81a4bbf',
            $actual
        );
    }

    /**
     * @covers AssinaturaEletronica\Implementacao\Assinador\OpenSSL\AssinadorOpenSslAdapter
     * @covers AssinaturaEletronica\Implementacao\Exception\ChavePrivadaException
     */
    public function testAssinarComChavePrivadaIncorreta()
    {
        $chavePrivada = <<<CHAVE_PRIVADA
-----BEGIN PRIVATE KEY-----
deadbeef
-----END PRIVATE KEY-----
CHAVE_PRIVADA;

        $assinador = new AssinadorOpenSslAdapter($chavePrivada);

        $this->expectException(ChavePrivadaException::class);
        $this->expectExceptionMessage('Falha ao carregar chave privada.');

        $assinador->assinar('foo');
    }

    /**
     * @covers AssinaturaEletronica\Implementacao\Assinador\OpenSSL\AssinadorOpenSslAdapter
     */
    public function testAssinarComAlgoritmoInvalido()
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

        $assinador = new AssinadorOpenSslAdapter($chavePrivada, null, 'foo');

        $this->expectWarning();
        $this->expectWarningMessage('openssl_sign(): Unknown digest algorithm');

        $assinador->assinar('foo');
    }
}
