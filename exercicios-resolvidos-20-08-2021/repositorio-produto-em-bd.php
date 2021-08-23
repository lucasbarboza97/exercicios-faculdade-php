<?php
namespace acme;

use PDOException;

require_once 'repositorio-produto.php';
require_once 'repositorio-exception.php';
require_once 'produto.php';

class RepositorioProdutoEmBD implements RepositorioProduto {

    private $pdo = null;

    public function __construct( \PDO &$pdo ) {
        $this->pdo = $pdo;
    }

    public function adicionar( Produto &$p ) {

        try {
            $ps = $this->pdo->prepare(
                'INSERT INTO produto ( nome, quantidade, preco ) VALUES ( ?, ?, ? )'
            );
            $ps->execute( [
                $p->getNome(),
                $p->getQuantidade(),
                $p->getPreco()
            ] );

            $p->setId( $this->pdo->lastInsertId() );

        } catch ( \PDOException $e ) {
            throw new RepositorioException(
                $e->getMessage(), $e->getCode(), $e );
        }
    }

    /** @inheritdoc */
    public function produtosComPrecoIgualOuSuperiorA( $valor ) {

        try {
            $ps = $this->pdo->prepare(
                'SELECT * FROM produto WHERE preco >= ?'
            );
            $ps->execute( [ $valor ] );

            $itens = $ps->fetchAll( \PDO::FETCH_ASSOC );
            $produtos = [];
            foreach ( $itens as $i ) {
                $produtos []= new Produto(
                    $i[ 'id' ],
                    $i[ 'nome' ],
                    $i[ 'quantidade' ],
                    $i[ 'preco' ],
                );
            }
            return $produtos;

        } catch ( \PDOException $e ) {
            throw new RepositorioException(
                $e->getMessage(), $e->getCode(), $e );
        }

    }
}
