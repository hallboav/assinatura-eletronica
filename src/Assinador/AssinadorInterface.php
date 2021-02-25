<?php declare(strict_types=1);

namespace AssinaturaEletronica\Assinador;

interface AssinadorInterface
{
    public function assinar(string $data): string;
}
