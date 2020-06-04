<?php

namespace AssinaturaEletronica\Formatador;

class FormatadorAssinaturaEletronica
{
    public static function formatar(string $assinatura, $charsPorLinha = 32, $charsPorBloco = 4, bool $uppercase = false): string
    {
        $hex = bin2hex($assinatura);

        if ($uppercase) {
            $hex = strtoupper($hex);
        }

        $lines = str_split($hex, $charsPorLinha);

        $buffer = '';
        foreach ($lines as $i => $line) {
            $isLastLine = $i === count($lines) - 1;

            $blocks = str_split($line, $charsPorBloco);
            $buffer = sprintf("%s%s%s", $buffer, implode(' ', $blocks), $isLastLine ? '' : PHP_EOL);
        }

        return $buffer;
    }
}
