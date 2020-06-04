## Biblioteca simplista para assinatura eletrônica (arquitetura hexagonal)

### Assinando e verificando assinatura de um documento do e-Docs usando OpenSSL:
```php
use AssinaturaEletronica\Formatador\FormatadorAssinaturaEletronica;
use AssinaturaEletronica\Implementacao\AssinaturaEletronica\Edocs\AssinadorEletronicoEdocs;
use AssinaturaEletronica\Implementacao\AssinaturaEletronica\Edocs\VerificadorAssinaturaEletronicaEdocs;
use AssinaturaEletronica\Implementacao\Factory\OpenSSL\OpenSslAssinadorFactory;
use AssinaturaEletronica\Implementacao\Factory\OpenSSL\OpenSslVerificadorAssinaturaFactory;
use AssinaturaEletronica\Implementacao\ParChaves\OpenSSL\GeradorParChavesOpenSslAdapter;
use AssinaturaEletronica\Implementacao\Repository\Doctrine\DoctrineAssinaturaRepository;
use AssinaturaEletronica\Implementacao\Repository\Doctrine\DoctrineParChavesRepository;

$connection = Doctrine\DBAL\DriverManager::getConnection(...);

//////////////////
/// Assinatura ///
//////////////////

$assinador = new AssinadorEletronicoEdocs(
    $assinaturaRepo = new DoctrineAssinaturaRepository($connection),
    $parChavesRepo = new DoctrineParChavesRepository($connection),
    new GeradorParChavesOpenSslAdapter(['private_key_bits' => 2048]),
    new OpenSslAssinadorFactory()
);

$assinatura = $assinador->assinarDocumento($idDocumento = 123, $dsDocumento = 'foo', $noUsuario = 'hallison.boaventura');
$assinaturaFormatada = FormatadorAssinaturaEletronica::formatar($assinatura, 64);
echo $assinaturaFormatada, PHP_EOL;

///////////////////
/// Verificação ///
///////////////////

$verificador = new VerificadorAssinaturaEletronicaEdocs(
    $assinaturaRepo,
    $parChavesRepo,
    new OpenSslVerificadorAssinaturaFactory()
);

$assinatura = $verificador->verificarAssinaturaDocumento($idDocumento, $dsDocumento, $noUsuario);
$isAssinaturaValida = null !== $assinatura;
```
