<?php

namespace AssinaturaEletronica\Implementacao\ParChaves\OpenSSL;

use AssinaturaEletronica\ParChaves\GeradorParChavesInterface;

class GeradorParChavesOpenSslAdapter implements GeradorParChavesInterface
{
    private $chavePrivada;
    private $chavePublica;

    public function __construct(array $opensslConfig = [])
    {
        $this->opensslConfig = $opensslConfig;
    }

    public function gerar(?string $senhaChavePrivada = null): void
    {
        $opensslConfig = array_replace(
            [
                'private_key_type' => OPENSSL_KEYTYPE_RSA,
                'private_key_bits' => 2048,
                'digest_alg'       => 'sha1',
            ],
            $this->opensslConfig
        );

        if (false === $keyPair = @openssl_pkey_new($opensslConfig)) {
            throw new \RuntimeException('Falha ao gerar par de chaves.');
        }

        if (false === @openssl_pkey_export($keyPair, $this->chavePrivada, $senhaChavePrivada)) {
            // @codeCoverageIgnoreStart
            throw new \RuntimeException('Falha ao exportar chave privada.');
            // @codeCoverageIgnoreEnd
        }

        $details = @openssl_pkey_get_details($keyPair);
        $this->chavePublica = $details['key'];
    }

    public function getChavePrivada(): string
    {
        return $this->chavePrivada;
    }

    public function getChavePublica(): string
    {
        return $this->chavePublica;
    }
}
