<?php

namespace AssinaturaEletronica\Implementacao\AssinaturaEletronica\Edocs;

use AssinaturaEletronica\AssinaturaEletronica\VerificadorAssinaturaEletronica;
use AssinaturaEletronica\Implementacao\Objeto\Edocs\ObjetoDespachoEdocs;
use AssinaturaEletronica\Implementacao\Objeto\Edocs\ObjetoDocumentoEdocs;

class VerificadorAssinaturaEletronicaEdocs extends VerificadorAssinaturaEletronica
{
    public function verificarAssinaturaDespacho(int $idDespacho, string $dsDespacho, string $noUsuario): ?string
    {
        $objeto = new ObjetoDespachoEdocs($idDespacho, $dsDespacho);

        return $this->verificar($objeto, $noUsuario);
    }

    public function verificarAssinaturaDocumento(int $idDocumento, string $dsDocumento, string $noUsuario): ?string
    {
        $objeto = new ObjetoDocumentoEdocs($idDocumento, $dsDocumento);

        return $this->verificar($objeto, $noUsuario);
    }
}
