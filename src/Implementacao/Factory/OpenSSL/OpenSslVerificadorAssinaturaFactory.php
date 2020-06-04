<?php

namespace AssinaturaEletronica\Implementacao\Factory\OpenSSL;

use AssinaturaEletronica\VerificadorAssinatura\VerificadorAssinaturaInterface;
use AssinaturaEletronica\Factory\AbstractVerificadorAssinaturaFactory;
use AssinaturaEletronica\Implementacao\VerificadorAssinatura\OpenSSL\VerificadorAssinaturaOpenSslAdapter;

class OpenSslVerificadorAssinaturaFactory extends AbstractVerificadorAssinaturaFactory
{
    public function createVerificadorAssinatura(string $chavePublica): VerificadorAssinaturaInterface
    {
        return new VerificadorAssinaturaOpenSslAdapter($chavePublica);
    }
}
