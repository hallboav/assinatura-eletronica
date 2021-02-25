<?php declare(strict_types=1);

namespace AssinaturaEletronica\Repository;

interface AssinaturaRepositoryInterface
{
    public function getAssinatura(string $recursoId): ?string;
    public function salvarAssinatura(string $recursoId, string $assinatura): void;
}
