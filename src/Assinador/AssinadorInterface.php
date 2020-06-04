<?php

namespace AssinaturaEletronica\Assinador;

interface AssinadorInterface
{
    public function assinar(string $data): string;
}
