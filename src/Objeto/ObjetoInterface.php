<?php declare(strict_types=1);

namespace AssinaturaEletronica\Objeto;

interface ObjetoInterface
{
    public function getId(): string;
    public function getData(): string;
}
