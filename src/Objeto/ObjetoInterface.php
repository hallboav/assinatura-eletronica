<?php

namespace AssinaturaEletronica\Objeto;

interface ObjetoInterface
{
    public function getId(): string;
    public function getData(): string;
}
