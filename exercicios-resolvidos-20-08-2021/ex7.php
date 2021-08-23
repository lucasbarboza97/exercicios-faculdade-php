<?php

$conteudo = file_get_contents( 'produtos.csv' );
$linhas = explode( PHP_EOL, $conteudo );
array_shift( $linhas );
$ultimoIndice = count( $linhas ) - 1;
if ( empty( $linhas[ $ultimoIndice ] ) ) {
    array_pop( $linhas );
}
array_pop( $linhas );

$html = '';
$html .= <<<'HTML'
<html>
<body>
    <table>
        <thead>
            <tr> <th>Descrição</th> <th>Estoque</th> <th>Preço (R$)</th> </tr>
        </thead>
        <tbody>\r\n
HTML;

$somaEstoque = 0;
foreach ( $linhas as $l ) {
    list( $descricao, $estoque, $preco ) = explode( ';', $l ); // [ 'Refrigerante', '30', '2' ]
    $somaEstoque += $estoque;
    $html .= <<<HTML
            <tr> <td>$descricao</td> <td>$estoque</td> <td>$preco</td> </tr>\r\n
HTML;
}

$html .= <<<HTML
        </tbody>
        <tfoot>
            <tr> <td></td> <td>$somaEstoque</td> <td></td> </tr>\r\n
        </tfoot>
    </table>
</body>
<html>
HTML;

// echo $html;

file_put_contents( 'produtos.html', $html );

?>