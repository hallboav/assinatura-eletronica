<?php

namespace AssinaturaEletronica\Factory;

use AssinaturaEletronica\VerificadorAssinatura\VerificadorAssinaturaInterface;

abstract class AbstractVerificadorAssinaturaFactory
{
    abstract public function createVerificadorAssinatura(string $chavePublica): VerificadorAssinaturaInterface;
}
