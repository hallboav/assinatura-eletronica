<?php declare(strict_types=1);

namespace AssinaturaEletronica\Exception;

class AssinaturaJaExisteException extends \RuntimeException
{
    private $assinatura;

    public function __construct(string $message, string $assinatura)
    {
        $this->assinatura = $assinatura;

        parent::__construct($message);
    }

    // @codeCoverageIgnoreStart
    public function getAssinatura(): string
    {
        return $this->assinatura;
    }
}
