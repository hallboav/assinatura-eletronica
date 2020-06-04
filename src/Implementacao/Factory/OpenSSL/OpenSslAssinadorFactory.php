<?php

namespace AssinaturaEletronica\Implementacao\Factory\OpenSSL;

use AssinaturaEletronica\Assinador\AssinadorInterface;
use AssinaturaEletronica\Factory\AbstractAssinadorFactory;
use AssinaturaEletronica\Implementacao\Assinador\OpenSSL\AssinadorOpenSslAdapter;

class OpenSslAssinadorFactory extends AbstractAssinadorFactory
{
    public function createAssinador(string $chavePrivada, ?string $senhaChavePrivada = null): AssinadorInterface
    {
        return new AssinadorOpenSslAdapter($chavePrivada, $senhaChavePrivada);
    }
}
