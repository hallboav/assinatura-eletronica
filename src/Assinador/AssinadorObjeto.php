<?php declare(strict_types=1);

namespace AssinaturaEletronica\Assinador;

use AssinaturaEletronica\Objeto\ObjetoInterface;

class AssinadorObjeto implements AssinadorObjetoInterface
{
    private $assinador;

    public function __construct(AssinadorInterface $assinador)
    {
        $this->assinador = $assinador;
    }

    public function assinarObjeto(ObjetoInterface $objeto): string
    {
        return $this->assinador->assinar($objeto->getData());
    }
}
