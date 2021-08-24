<?php

// Conexão BD    
$pdo = null;
try{
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=exemplo', 'root', 'senha_desejada',
    [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
);
}catch (PDOException $e ) {
    die('Falha ao conectar: '. $e->getMessage());
}

$ps = $pdo->query( 'SELECT * FROM produto'); 
$produtos = $ps->fetchAll(); // Select armazenado numa variavel.

foreach($produtos as $produto){
    echo 'Produto: ', $produto['nome'],' -- qtde: ', $produto['quantidade'],' -- preço: ',$produto['preco'], PHP_EOL;
}
?>