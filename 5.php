<?php

    $inventores = [
        [ "nome" => 'Albert', "sobrenome" => 'Einstein', "nasc" => 1879, "morte" => 1955 ],
        [ "nome" => 'Isaac', "sobrenome" => 'Newton', "nasc" => 1643, "morte" => 1727 ],
        [ "nome" => 'Galileo', "sobrenome" => 'Galilei', "nasc" => 1564, "morte" => 1642 ],
        [ "nome" => 'Nicolaus', "sobrenome" => 'Copernicus', "nasc" => 1473, "morte" => 1543 ],
        [ "nome" => 'Ada', "sobrenome" => 'Lovelace', "nasc" => 1815, "morte" => 1852 ]
    ];



    // Questão 5.a
    $aSobrnomeViveu = [retornaSobrenomeIdade($inventores)];
    function retornaSobrenomeIdade ($array){
        $i = 0;
        foreach($array as $inventor){           
            $array[$i] = [ 'sobrenome' => $inventor['sobrenome'], 'viveu' => $inventor['morte']-$inventor['nasc']];
            $i++;
        }
        return $array;
    }


    // Questão 5.b
    $media = retornaMediaAnos($inventores);
    function retornaMediaAnos ($array){
        $idade = [];
        foreach($array as $inventor){           
            array_push( $idade, $inventor['morte']-$inventor['nasc'] );
        }

        return array_sum($idade) / count( $idade );
    }

    // Questão 5.c
    
?>
