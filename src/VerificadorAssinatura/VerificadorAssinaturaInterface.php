<?php

namespace AssinaturaEletronica\VerificadorAssinatura;

interface VerificadorAssinaturaInterface
{
    public function verificarAssinatura(string $data, string $assinatura): bool;
}
