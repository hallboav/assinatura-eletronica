<?php declare(strict_types=1);

namespace AssinaturaEletronica\VerificadorAssinatura;

interface VerificadorAssinaturaInterface
{
    public function verificarAssinatura(string $data, string $assinatura): bool;
}
