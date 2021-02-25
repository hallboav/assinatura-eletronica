<?php declare(strict_types=1);

namespace AssinaturaEletronica\Implementacao\Objeto\Edocs;

use AssinaturaEletronica\Objeto\ObjetoInterface;

class ObjetoDocumentoEdocs implements ObjetoInterface
{
    private $idDocumento;
    private $dsDocumento;

    public function __construct(int $idDocumento, string $dsDocumento)
    {
        $this->idDocumento = $idDocumento;
        $this->dsDocumento = $dsDocumento;
    }

    public function getId(): string
    {
        return sprintf('documento_%d', $this->idDocumento);
    }

    public function getData(): string
    {
        return $this->dsDocumento;
    }
}
