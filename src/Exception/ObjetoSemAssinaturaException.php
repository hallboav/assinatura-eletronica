<?php declare(strict_types=1);

namespace AssinaturaEletronica\Exception;

use AssinaturaEletronica\Objeto\ObjetoInterface;

class ObjetoSemAssinaturaException extends \RuntimeException
{
    private $objeto;

    public function __construct(string $message, ObjetoInterface $objeto)
    {
        $this->objeto = $objeto;

        parent::__construct($message);
    }

    // @codeCoverageIgnoreStart
    public function getObjeto(): ObjetoInterface
    {
        return $this->objeto;
    }
}
