<?php

$inventores = [
    [ "nome" => 'Albert', "sobrenome" => 'Einstein', "nasc" => 1879, "morte" => 1955 ],
    [ "nome" => 'Isaac', "sobrenome" => 'Newton', "nasc" => 1643, "morte" => 1727 ],
    [ "nome" => 'Galileo', "sobrenome" => 'Galilei', "nasc" => 1564, "morte" => 1642 ],
    [ "nome" => 'Nicolaus', "sobrenome" => 'Copernicus', "nasc" => 1473, "morte" => 1543 ],
    [ "nome" => 'Ada', "sobrenome" => 'Lovelace', "nasc" => 1815, "morte" => 1852 ]
];


function gerarIdades( &$inventores ) {
    $resultado = [];
    foreach ( $inventores as $inv ) {
        $linha = [
            'sobrenome' => $inv[ 'sobrenome' ],
            'viveu' => ( $inv[ 'morte' ] - $inv[ 'nasc' ] ) + 1
        ];
        $resultado []= $linha;
    }
    return $resultado;
}


function mediaVivida( &$inventores ) {
    $soma = 0;
    foreach ( $inventores as $inv ) {
        $soma += ( $inv[ 'morte' ] - $inv[ 'nasc' ] ) + 1;
    }
    $contagem = count( $inventores );
    if ( $contagem === 0 ) {
        throw new RuntimeException( 'O array não deve estar vazio.' );
    }
    return $soma / $contagem;
}


function inventoresDoSeculo( array &$inventores, $seculo ) {
    $resultado = [];
    $anoInicial = ( $seculo - 1 ) . '00';
    $anoFinal = ( $seculo - 1 ) . '99';

    foreach ( $inventores as $inv ) { // 1572 -> 16 , 1620 -> 17

        $nasceuNoIntervaloDoSeculo = $inv[ 'nasc' ] >= $anoInicial && $inv[ 'nasc' ] <= $anoFinal;
        $morreuNoIntervaloDoSeculo = $inv[ 'morte' ] >= $anoInicial && $inv[ 'morte' ] <= $anoFinal;

        if ( $nasceuNoIntervaloDoSeculo || $morreuNoIntervaloDoSeculo ) {
            $resultado []= $inv;
        }
    }
    return $resultado;

    // $anoInicial = ( $seculo - 1 ) . '00';
    // $anoFinal = ( $seculo - 1 ) . '99';

    // return array_filter( $inventores, function( $inv ) use ( $anoInicial, $anoFinal ) {
    //     $nasceuNoIntervaloDoSeculo = $inv[ 'nasc' ] >= $anoInicial && $inv[ 'nasc' ] <= $anoFinal;
    //     $morreuNoIntervaloDoSeculo = $inv[ 'morte' ] >= $anoInicial && $inv[ 'morte' ] <= $anoFinal;

    //     if ( $nasceuNoIntervaloDoSeculo || $morreuNoIntervaloDoSeculo ) {
    //         return true;
    //     }
    //     return false;
    // } );
}


// try {
//     $exemplo = [];
//     var_dump(
//         mediaVivida( $exemplo )
//     );
// } catch ( Exception $e ) {
//     echo 'Ocorreu um problema: ', $e->getMessage();
// }

function compararSobrenome( $a, $b ) {

    if ( $a[ 'sobrenome' ] === $b[ 'sobrenome' ] ) {
        return 0;
    }

    if ( $a[ 'sobrenome' ] > $b[ 'sobrenome' ] ) {
        return 1;
    }

    return -1;
}

function ordenarPeloSobrenome( $inventores ) {
    usort( $inventores, 'compararSobrenome' );
    return $inventores;
}


var_dump( ordenarPeloSobrenome( $inventores ) );

?>