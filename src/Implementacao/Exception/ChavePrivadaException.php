<?php declare(strict_types=1);

namespace AssinaturaEletronica\Implementacao\Exception;

class ChavePrivadaException extends \RuntimeException
{
    private $pemStringChavePrivada;
    private $senhaChavePrivada;

    public function __construct(string $message, string $pemStringChavePrivada, ?string $senhaChavePrivada)
    {
        $this->pemStringChavePrivada = $pemStringChavePrivada;
        $this->senhaChavePrivada = $senhaChavePrivada;

        parent::__construct($message);
    }

    // @codeCoverageIgnoreStart
    public function getPemStringChavePrivada(): string
    {
        return $this->pemStringChavePrivada;
    }

    public function getSenhaChavePrivada(): ?string
    {
        return $this->senhaChavePrivada;
    }
}
