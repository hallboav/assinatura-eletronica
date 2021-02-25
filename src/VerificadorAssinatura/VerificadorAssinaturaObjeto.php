<?php declare(strict_types=1);

namespace AssinaturaEletronica\VerificadorAssinatura;

use AssinaturaEletronica\Objeto\ObjetoInterface;

class VerificadorAssinaturaObjeto implements VerificadorAssinaturaObjetoInterface
{
    private $verificador;

    public function __construct(VerificadorAssinaturaInterface $verificador)
    {
        $this->verificador = $verificador;
    }

    public function verificarAssinaturaObjeto(ObjetoInterface $objeto, string $assinatura): bool
    {
        return $this->verificador->verificarAssinatura($objeto->getData(), $assinatura);
    }
}
