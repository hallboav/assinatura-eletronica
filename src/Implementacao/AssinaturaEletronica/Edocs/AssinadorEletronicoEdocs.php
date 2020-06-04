<?php

namespace AssinaturaEletronica\Implementacao\AssinaturaEletronica\Edocs;

use AssinaturaEletronica\AssinaturaEletronica\AssinadorEletronico;
use AssinaturaEletronica\Implementacao\Objeto\Edocs\ObjetoDespachoEdocs;
use AssinaturaEletronica\Implementacao\Objeto\Edocs\ObjetoDocumentoEdocs;

class AssinadorEletronicoEdocs extends AssinadorEletronico
{
    public function assinarDespacho(int $idDespacho, string $dsDespacho, string $noUsuario): string
    {
        $objeto = new ObjetoDespachoEdocs($idDespacho, $dsDespacho);

        return $this->assinar($objeto, $noUsuario);
    }

    public function assinarDocumento(int $idDocumento, string $dsDocumento, string $noUsuario): string
    {
        $objeto = new ObjetoDocumentoEdocs($idDocumento, $dsDocumento);

        return $this->assinar($objeto, $noUsuario);
    }
}
