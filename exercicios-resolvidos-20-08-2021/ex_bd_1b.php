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

do {
    echo '1) Cadastrar', PHP_EOL;
    echo '0) Sair', PHP_EOL;
    $escolha = readline( 'Escolha: ' );
    if ( $escolha == '1' ) {
        echo '--- PRODUTO ---', PHP_EOL;
        $nome = utf8_encode( readline( 'Nome  : ' ) );
        $qtde = readline( 'Qtde. : ' );
        $preco = readline( 'Preço : ' );
        echo str_repeat( '-', 20 ), PHP_EOL;
        $p = new Produto( $nome, $qtde, $preco );
        try {
            $repo->adicionar( $p );
            echo 'Produto inserido com ID ', $p->getId(), PHP_EOL;
        } catch ( RepositorioException $e ) {
            echo 'Erro ao inserir produto: ' . $e->getMessage(), PHP_EOL;
        }
    }

} while ( $escolha != '0' );

?>