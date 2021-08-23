<?php

function formatarTelefone( $telefone ) {

    if ( ! is_numeric( $telefone ) ) {
        return $telefone;
    }

    $comprimento = mb_strlen( $telefone );
    if ( $comprimento === 8 ) { // 30044000
        $p1 = mb_substr( $telefone, 0, 4 ); // 3004
        $p2 = mb_substr( $telefone, 4, 4 ); // 4000
        return $p1 . ' ' . $p2;
    } else if ( $comprimento === 10 ) { // 2225271727
        $p1 = mb_substr( $telefone, 0, 2 ); // 22
        $p2 = mb_substr( $telefone, 2, 4 ); // 2527
        $p3 = mb_substr( $telefone, 6, 4 ); // 1727
        return "($p1) $p2-$p3";
    } else if ( $comprimento === 11 ) { // 22987654321
        $inicio = mb_substr( $telefone, 0, 4 );

        if ( $inicio === '0800' || $inicio === '0300' ) { // 08007024000
            $p1 = $inicio;
            $p2 = mb_substr( $telefone, 4, 3 ); // 702
            $p3 = mb_substr( $telefone, 7, 4 ); // 4000
            return "$p1 $p2 $p3";
        }

        $p1 = mb_substr( $telefone, 0, 2 ); // 22
        $p2 = mb_substr( $telefone, 2, 1 ); // 9
        $p3 = mb_substr( $telefone, 3, 4 ); // 8765
        $p4 = mb_substr( $telefone, 7, 4 ); // 4321
        return "($p1) $p2-$p3-$p4";
    }
}

// echo formatarTelefone( '30044000' );
// echo formatarTelefone( '2225271727' );
// echo formatarTelefone( '22987654321' );
// echo formatarTelefone( '08007024000' );
 echo formatarTelefone( 'A' );


?>