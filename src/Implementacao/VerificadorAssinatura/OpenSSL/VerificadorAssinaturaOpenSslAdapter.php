<?php

namespace AssinaturaEletronica\Implementacao\VerificadorAssinatura\OpenSSL;

use AssinaturaEletronica\VerificadorAssinatura\VerificadorAssinaturaInterface;

class VerificadorAssinaturaOpenSslAdapter implements VerificadorAssinaturaInterface
{
    private $pemStringChavePublica;
    private $algoritmoAssinatura;

    public function __construct(string $pemStringChavePublica, string $algoritmoAssinatura = 'sha1')
    {
        $this->pemStringChavePublica = $pemStringChavePublica;
        $this->algoritmoAssinatura = $algoritmoAssinatura;
    }

    public function verificarAssinatura(string $data, string $assinatura): bool
    {
        if (false === $pubkeyid = @openssl_pkey_get_public($this->pemStringChavePublica)) {
            throw new \RuntimeException('Chave pública inválida.');
        }

        if (false === $isOk = @openssl_verify($data, $assinatura, $pubkeyid, $this->algoritmoAssinatura)) {
            throw new \RuntimeException('Falha ao verificar assinatura.');
        }

        @openssl_free_key($pubkeyid);

        return 1 === $isOk;
    }
}
