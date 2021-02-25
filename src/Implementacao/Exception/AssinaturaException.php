<?php declare(strict_types=1);

namespace AssinaturaEletronica\Implementacao\Exception;

class AssinaturaException extends \RuntimeException
{
    private $data;
    private $assinatura;
    private $chavePrivada;
    private $algoritmoAssinatura;

    public function __construct(
        string $message,
        string $data,
        string $assinatura,
        \OpenSSLAsymmetricKey $chavePrivada,
        string $algoritmoAssinatura
    ) {
        $this->data = $data;
        $this->assinatura = $assinatura;
        $this->chavePrivada = $chavePrivada;
        $this->algoritmoAssinatura = $algoritmoAssinatura;

        parent::__construct($message);
    }

    // @codeCoverageIgnoreStart
    public function getData(): string
    {
        return $this->data;
    }

    public function getAssinatura(): string
    {
        return $this->assinatura;
    }

    public function getChavePrivada(): \OpenSSLAsymmetricKey
    {
        return $this->chavePrivada;
    }

    public function getAlgoritmoAssinatura(): string
    {
        return $this->algoritmoAssinatura;
    }
}
