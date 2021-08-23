<?php
namespace acme;

require_once 'produto.php';

/**
 * @author Thiago
 */
interface RepositorioProduto {

    /**
     * @throws RepositorioException
     */
    function adicionar( Produto &$p );

    /**
     * Retorna os produtos com preço igual ou superior ao informado.
     *
     * @param float $valor Valor do preço
     * @throws RepositorioException
     */
    function produtosComPrecoIgualOuSuperiorA( $valor );

}