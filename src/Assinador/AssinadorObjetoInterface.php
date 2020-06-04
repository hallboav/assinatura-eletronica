<?php

namespace AssinaturaEletronica\Assinador;

use AssinaturaEletronica\Objeto\ObjetoInterface;

interface AssinadorObjetoInterface
{
    public function assinarObjeto(ObjetoInterface $objeto): string;
}
