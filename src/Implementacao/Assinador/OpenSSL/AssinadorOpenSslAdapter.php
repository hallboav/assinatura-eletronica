<?php declare(strict_types=1);

namespace AssinaturaEletronica\Implementacao\Assinador\OpenSSL;

use AssinaturaEletronica\Assinador\AssinadorInterface;
use AssinaturaEletronica\Implementacao\Exception\AssinaturaException;
use AssinaturaEletronica\Implementacao\Exception\ChavePrivadaException;

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
        if (false === $chavePrivada = openssl_pkey_get_private($this->pemStringChavePrivada, $this->senhaChavePrivada)) {
            throw new ChavePrivadaException(
                'Falha ao carregar chave privada.',
                $this->pemStringChavePrivada,
                $this->senhaChavePrivada
            );
        }

        $assinatura = '';
        if (false === openssl_sign($data, $assinatura, $chavePrivada, $this->algoritmoAssinatura)) {
            throw new AssinaturaException(
                'Falha ao assinar.',
                $data,
                $assinatura,
                $chavePrivada,
                $this->algoritmoAssinatura
            );
        }

        return $assinatura;
    }
}
