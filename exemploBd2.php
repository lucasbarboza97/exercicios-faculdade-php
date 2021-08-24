<?php

if($_SERVER['argc']<2){
    die("Informe o preço.");
}
$preco = $_SERVER['argv'][1];

// Conexão BD    
$pdo = null;
try{
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=exemplo', 'root', 'senha_desejada',
    [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
);
}catch (PDOException $e ) {
    die('Falha ao conectar: '. $e->getMessage());
}

try{
    $ps = $pdo->prepare('SELECT * FROM produto WHERE preco >= ?');
    $ps->execute([$preco]);

    while($obj = $ps->fetchObject()){
        echo $obj->nome, PHP_EOL; 
    }
}catch(Exception $e){
    echo 'Erro ao consultar produto: ',$e->getMessage();
}
?>