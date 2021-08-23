<?php

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

function inserirProduto( &$pdo, $nome, $estoque, $preco ) {
    $ps = $pdo->prepare(
        'INSERT INTO produto ( nome, quantidade, preco ) VALUES ( ?, ?, ? )'
    );
    $ps->execute( [ $nome, $estoque, $preco ] );
    return $pdo->lastInsertId();
}

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
        try {
            $id = inserirProduto( $pdo, $nome, $qtde, $preco );
            echo 'Produto inserido com ID ', $id, PHP_EOL;
        } catch ( PDOException $e ) {
            echo 'Erro ao inserir produto: ' . $e->getMessage(), PHP_EOL;
        }
    }

} while ( $escolha != '0' );

?>