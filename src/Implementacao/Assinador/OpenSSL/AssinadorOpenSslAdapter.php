<?php

namespace AssinaturaEletronica\Implementacao\Assinador\OpenSSL;

use AssinaturaEletronica\Assinador\AssinadorInterface;

class AssinadorOpenSslAdapter implements AssinadorInterface
{
    private $pemStringChavePrivada;
    private $senhaChavePrivada;
    private $algoritmoAssinatura;

    public function __construct(string $pemStringChavePrivada, ?string $senhaChavePrivada = null, string $algoritmoAssinatura = 'sha1')
    {
        $this->pemStringChavePrivada = $pemStringChavePrivada;
        $this->senhaChavePrivada = $senhaChavePrivada;
        $this->algoritmoAssinatura = $algoritmoAssinatura;
    }

    public function assinar(string $data): string
    {
        if (false === $chavePrivada = @openssl_pkey_get_private($this->pemStringChavePrivada, $this->senhaChavePrivada)) {
            throw new \RuntimeException('Falha ao carregar chave privada.');
        }

        $assinatura = '';
        if (false === @openssl_sign($data, $assinatura, $chavePrivada, $this->algoritmoAssinatura)) {
            throw new \RuntimeException('Falha ao assinar.');
        }

        return $assinatura;
    }
}
