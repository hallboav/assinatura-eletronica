<?php declare(strict_types=1);

namespace AssinaturaEletronica\Tests\Formatador;

use AssinaturaEletronica\Formatador\FormatadorAssinaturaEletronica;
use PHPUnit\Framework\TestCase;

class FormatadorAssinaturaEletronicaTest extends TestCase
{
    /**
     * @covers AssinaturaEletronica\Formatador\FormatadorAssinaturaEletronica
     */
    public function testFormatar()
    {
        $assinatura = hex2bin('b0c8a26c35a7124f7c7cbfa9a09e09640a87eba4366c59b335bc4a51eb52c7f99a46f8f235c68794b8c1d68ae320f703fe1f454bfa6529f81a4fb58a728e37cc');

        $assinaturaFormatada = <<<ASSINATURA_FORMATADA
b0c8 a26c 35a7 124f 7c7c bfa9 a09e 0964
0a87 eba4 366c 59b3 35bc 4a51 eb52 c7f9
9a46 f8f2 35c6 8794 b8c1 d68a e320 f703
fe1f 454b fa65 29f8 1a4f b58a 728e 37cc
ASSINATURA_FORMATADA;

        $this->assertEquals(
            $assinaturaFormatada,
            FormatadorAssinaturaEletronica::formatar($assinatura)
        );
    }

    /**
     * @covers AssinaturaEletronica\Formatador\FormatadorAssinaturaEletronica
     */
    public function testFormatarUppercase()
    {
        $assinatura = hex2bin('b0c8a26c35a7124f7c7cbfa9a09e09640a87eba4366c59b335bc4a51eb52c7f99a46f8f235c68794b8c1d68ae320f703fe1f454bfa6529f81a4fb58a728e37cc');

        $assinaturaFormatada = <<<ASSINATURA_FORMATADA
B0C8 A26C 35A7 124F 7C7C BFA9 A09E 0964
0A87 EBA4 366C 59B3 35BC 4A51 EB52 C7F9
9A46 F8F2 35C6 8794 B8C1 D68A E320 F703
FE1F 454B FA65 29F8 1A4F B58A 728E 37CC
ASSINATURA_FORMATADA;

        $this->assertEquals(
            $assinaturaFormatada,
            FormatadorAssinaturaEletronica::formatar($assinatura, 32, 4, true)
        );
    }

    /**
     * @covers AssinaturaEletronica\Formatador\FormatadorAssinaturaEletronica
     */
    public function testFormatarComCharsPorLinhaECharsPorBlocosDiferentes()
    {
        $assinatura = hex2bin('b0c8a26c35a7124f7c7cbfa9a09e09640a87eba4366c59b335bc4a51eb52c7f99a46f8f235c68794b8c1d68ae320f703fe1f454bfa6529f81a4fb58a728e37cc');

        $assinaturaFormatada = <<<ASSINATURA_FORMATADA
B0 C8 A2 6C
35 A7 12 4F
7C 7C BF A9
A0 9E 09 64
0A 87 EB A4
36 6C 59 B3
35 BC 4A 51
EB 52 C7 F9
9A 46 F8 F2
35 C6 87 94
B8 C1 D6 8A
E3 20 F7 03
FE 1F 45 4B
FA 65 29 F8
1A 4F B5 8A
72 8E 37 CC
ASSINATURA_FORMATADA;

        $this->assertEquals(
            $assinaturaFormatada,
            FormatadorAssinaturaEletronica::formatar($assinatura, 8, 2, true)
        );
    }
}
