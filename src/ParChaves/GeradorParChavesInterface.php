<?php

namespace AssinaturaEletronica\ParChaves;

interface GeradorParChavesInterface
{
    public function gerar(?string $senhaChavePrivada = null): void;
    public function getChavePrivada(): string;
    public function getChavePublica(): string;
}
