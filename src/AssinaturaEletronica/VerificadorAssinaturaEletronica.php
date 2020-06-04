<?php

namespace AssinaturaEletronica\AssinaturaEletronica;

use AssinaturaEletronica\Exception\ChavePublicaNaoEncontradaException;
use AssinaturaEletronica\Exception\ObjetoSemAssinaturaException;
use AssinaturaEletronica\Factory\AbstractVerificadorAssinaturaFactory;
use AssinaturaEletronica\Objeto\ObjetoInterface;
use AssinaturaEletronica\Repository\AssinaturaRepositoryInterface;
use AssinaturaEletronica\Repository\ParChavesRepositoryInterface;
use AssinaturaEletronica\VerificadorAssinatura\VerificadorAssinaturaObjeto;

class VerificadorAssinaturaEletronica
{
    private $assinaturaRepository;
    private $parChavesRepository;
    private $verificadorAssinaturaFactory;

    public function __construct(
        AssinaturaRepositoryInterface $assinaturaRepository,
        ParChavesRepositoryInterface $parChavesRepository,
        AbstractVerificadorAssinaturaFactory $verificadorAssinaturaFactory
    ) {
        $this->assinaturaRepository = $assinaturaRepository;
        $this->parChavesRepository = $parChavesRepository;
        $this->verificadorAssinaturaFactory = $verificadorAssinaturaFactory;
    }

    public function verificar(ObjetoInterface $objeto, string $noUsuario): ?string
    {
        if (null === $chavePublica = $this->parChavesRepository->getChavePublica($noUsuario)) {
            throw new ChavePublicaNaoEncontradaException('O usuário não possui uma chave pública.', $noUsuario);
        }

        if (null === $assinatura = $this->assinaturaRepository->getAssinatura($objeto->getId())) {
            throw new ObjetoSemAssinaturaException('O objeto ainda não foi assinado.', $objeto);
        }

        $verificadorAssinatura = $this->verificadorAssinaturaFactory->createVerificadorAssinatura($chavePublica);
        $verificadorAssinaturaObjeto = new VerificadorAssinaturaObjeto($verificadorAssinatura);
        if (!$verificadorAssinaturaObjeto->verificarAssinaturaObjeto($objeto, $assinatura)) {
            return null;
        }

        return $assinatura;
    }
}
