<?php

namespace AssinaturaEletronica\AssinaturaEletronica;

use AssinaturaEletronica\Assinador\AssinadorObjeto;
use AssinaturaEletronica\Exception\AssinaturaJaExisteException;
use AssinaturaEletronica\Factory\AbstractAssinadorFactory;
use AssinaturaEletronica\Objeto\ObjetoInterface;
use AssinaturaEletronica\ParChaves\GeradorParChavesInterface;
use AssinaturaEletronica\Repository\AssinaturaRepositoryInterface;
use AssinaturaEletronica\Repository\ParChavesRepositoryInterface;

class AssinadorEletronico
{
    private $assinaturaRepository;
    private $parChavesRepository;
    private $geradorParChaves;
    private $assinadorFactory;

    public function __construct(
        AssinaturaRepositoryInterface $assinaturaRepository,
        ParChavesRepositoryInterface $parChavesRepository,
        GeradorParChavesInterface $geradorParChaves,
        AbstractAssinadorFactory $assinadorFactory
    ) {
        $this->assinaturaRepository = $assinaturaRepository;
        $this->parChavesRepository = $parChavesRepository;
        $this->geradorParChaves = $geradorParChaves;
        $this->assinadorFactory = $assinadorFactory;
    }

    public function assinar(ObjetoInterface $objeto, string $noUsuario): string
    {
        if (null !== $assinatura = $this->assinaturaRepository->getAssinatura($objeto->getId())) {
            throw new AssinaturaJaExisteException('Assinatura já existe.', $assinatura);
        }

        if (null === $chavePrivada = $this->parChavesRepository->getChavePrivada($noUsuario)) {
            $this->geradorParChaves->gerar();
            $chavePrivada = $this->geradorParChaves->getChavePrivada();
            $this->parChavesRepository->salvarParChaves($noUsuario, $chavePrivada, $this->geradorParChaves->getChavePublica());
        }

        $assinador = $this->assinadorFactory->createAssinador($chavePrivada);
        $assinadorObjeto = new AssinadorObjeto($assinador);
        $assinatura = $assinadorObjeto->assinarObjeto($objeto);

        $this->assinaturaRepository->salvarAssinatura($objeto->getId(), $assinatura);

        return $assinatura;
    }
}
