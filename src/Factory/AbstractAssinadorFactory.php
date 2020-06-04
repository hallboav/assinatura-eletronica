<?php

namespace AssinaturaEletronica\Factory;

use AssinaturaEletronica\Assinador\AssinadorInterface;

abstract class AbstractAssinadorFactory
{
    abstract public function createAssinador(string $chavePrivada, ?string $senhaChavePrivada = null): AssinadorInterface;
}
