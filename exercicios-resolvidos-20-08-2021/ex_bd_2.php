<?php
require_once 'repositorio-produto-em-bd.php';
require_once 'repositorio-exception.php';
require_once 'produto.php';

use acme\Produto;
use acme\RepositorioProdutoEmBD;
use acme\RepositorioException;

$pdo = null;
try {
    $pdo = new PDO( 'mysql:dbname=acme4;host=localhost;charset=UTF8', 'root', '',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8';"
    ] );
} catch ( Exception $e ) {
    die( 'Erro: ' . $e->getMessage() );
}

$repo = new RepositorioProdutoEmBD( $pdo );


list( , $preco ) = $_SERVER[ 'argv' ]; // [ '...php', 100, 200 ];
if ( ! isset($preco)) {
    die( 'Informe o preço' );
}

$produtos = [];
try {
    $produtos = $repo->produtosComPrecoIgualOuSuperiorA( $preco );
} catch ( RepositorioException $e ) {
    die( $e->getMessage() );
}

foreach ( $produtos as $p ) {
    echo $p->getNome(), PHP_EOL;
}

?>