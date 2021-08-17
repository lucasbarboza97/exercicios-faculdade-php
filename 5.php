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
    //$media = retornaMediaAnos($inventores);
    function retornaMediaAnos ($array){
        $idade = [];
        foreach($array as $inventor){           
            array_push( $idade, $inventor['morte']-$inventor['nasc'] );
        }

        return array_sum($idade) / count( $idade );
    }


    // Questão 5.c
    // $inventoresViveuNoSeculo = verificaSeculo($inventores,17);
    // var_dump($inventoresViveuNoSeculo);
    function verificaSeculo ($array,$seculo){
        // Cria variáveis para o primeiro e último ano de um século
        $finalSeculo = 100*$seculo;
        $inicioSeculo = $finalSeculo-99;
        $cont = 0;      
        foreach($array as $inventor){           
            $nascimento = $inventor['nasc'];
            $morte = $inventor['morte'];
            for($i=$nascimento;$i<=$morte;$i++){
                for($j=$inicioSeculo;$j<=$finalSeculo;$j++){
                    if($i==$j){
                        $arrayViveu [$cont]= [$inventor['nome']];
                        $cont++;
                    }
                }
            }          
        }
        $arrayViveu = array_unique($arrayViveu, SORT_REGULAR);
        return $arrayViveu;
    }


    //Questão 5.d
    ordenaSobrenome($inventores);
    function ordenaSobrenome($array){
        $i = 0;
        foreach($array as $inventor){           
            $arraySemNome[$i] = [ 'sobrenome' => $inventor['sobrenome'], 'nasc' => $inventor['nasc'], 'morte' => $inventor['morte']];
            $i++;
        }
        sort($arraySemNome);
        var_dump($arraySemNome);
    }
?>