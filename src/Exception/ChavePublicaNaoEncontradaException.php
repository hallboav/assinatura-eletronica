<?php declare(strict_types=1);

namespace AssinaturaEletronica\Exception;

class ChavePublicaNaoEncontradaException extends \RuntimeException
{
    private $noUsuario;

    public function __construct(string $message, string $noUsuario)
    {
        $this->noUsuario = $noUsuario;

        parent::__construct($message);
    }

    // @codeCoverageIgnoreStart
    public function getNoUsuario(): string
    {
        return $this->noUsuario;
    }
}
