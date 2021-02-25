<?php declare(strict_types=1);

namespace AssinaturaEletronica\Repository;

interface ParChavesRepositoryInterface
{
    public function getChavePrivada(string $noUsuario): ?string;
    public function getChavePublica(string $noUsuario): ?string;
    public function salvarParChaves(string $noUsuario, string $chavePrivada, string $chavePublica): void;
}
