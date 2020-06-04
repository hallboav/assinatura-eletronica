<?php

namespace AssinaturaEletronica\VerificadorAssinatura;

use AssinaturaEletronica\Objeto\ObjetoInterface;

interface VerificadorAssinaturaObjetoInterface
{
    public function verificarAssinaturaObjeto(ObjetoInterface $objeto, string $assinatura): bool;
}
