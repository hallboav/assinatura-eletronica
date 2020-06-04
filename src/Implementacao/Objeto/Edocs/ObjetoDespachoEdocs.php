<?php

namespace AssinaturaEletronica\Implementacao\Objeto\Edocs;

use AssinaturaEletronica\Objeto\ObjetoInterface;

class ObjetoDespachoEdocs implements ObjetoInterface
{
    private $idDespacho;
    private $dsDespacho;

    public function __construct(int $idDespacho, string $dsDespacho)
    {
        $this->idDespacho = $idDespacho;
        $this->dsDespacho = $dsDespacho;
    }

    public function getId(): string
    {
        return sprintf('despacho_%d', $this->idDespacho);
    }

    public function getData(): string
    {
        return $this->dsDespacho;
    }
}
