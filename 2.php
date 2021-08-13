<?php
    // Exercício 2

    function formataTel ($telefone) {

        $tamanho = strlen($telefone);
        $inicialNumGratuito = substr($telefone, 0, 4);

        if($tamanho == 8){
            $telFixo = str_split($telefone,4);           
            return implode("-",$telFixo);
        }
        elseif($tamanho == 10){

            $ddd = substr($telefone, 0, 2);
            $numero = substr($telefone, 2);
            
            $telFixoSemDDD = str_split($numero,4);
            $numTelFormatadoTraco = implode("-",$telFixoSemDDD);

            return "($ddd) $numTelFormatadoTraco"; 
        }
        elseif($tamanho == 11 && $inicialNumGratuito == '0800' || $tamanho == 11 && $inicialNumGratuito == '0300'){

            $num2 = substr($telefone, 4, 3);
            $num3 = substr($telefone, 7);

            return "$inicialNumGratuito $num2 $num3"; 
        }
        elseif($tamanho == 11){

            $ddd = substr($telefone, 0, 2);
            $digito = substr($telefone, 2, 1);
            $numero = substr($telefone, 3);
            
            $telFixoSemDDDSemDigito = str_split($numero,4);
            $numTelFormatadoTraco = implode("-",$telFixoSemDDDSemDigito);

            return "($ddd) $digito-$numTelFormatadoTraco"; 
        }

        else{
            return $telefone;
        }
    }
    // // Parte do exercício 2

    // $numTel = formataTel('(229-9253-3073');
    // $numTel1 = formataTel('08002223333');
    // $numTel2 = formataTel('25225430');
    // $numTel3 = formataTel('992533073');
    // $numTel4 = formataTel('2225205951');
    // $numTel5 = formataTel('(2224603');
    // $numTel6 = formataTel('+5522992533073');
    // $numTel7= formataTel('22992533073');

    // echo$numTel, PHP_EOL;
    // echo$numTel1, PHP_EOL;
    // echo$numTel2, PHP_EOL;
    // echo$numTel3, PHP_EOL;
    // echo$numTel4, PHP_EOL;
    // echo$numTel5, PHP_EOL;
    // echo$numTel6, PHP_EOL;
    // echo$numTel7, PHP_EOL;



    // Exercício 3

    $telefones = [ '08002223333', '25225430', '992533073', '2225205951', '(2224603', '+5522992533073', '22992533073'];

    recebeArray($telefones);

    function recebeArray(&$telefones){
        foreach($telefones as $indice => $elemento){
            $numTel = formataTel($telefones[$indice]);
            echo "O número não formatado: $elemento.", PHP_EOL, "O número formatado: $numTel", PHP_EOL, PHP_EOL;
        }
    }


    // Exercício 4

    function verificaRepetido(&$telefones){

        

    }
?>
