<?php
namespace acme;

require_once 'nomeavel.php';

class Produto {

    use Nomeavel;

    private $id = 0;
    private $quantidade = 1;
    private $preco = 0.01;

    function __construct( $id = 0, $nome = '', $quantidade = 1, $preco = 0.01 ) {
        $this->setId( $id );
        $this->setNome( $nome );
        $this->setQuantidade( $quantidade );
        $this->setPreco( $preco );
    }

    function getId() { return $this->id; }
    function setId( $id ) { $this->id = $id; }

    function getQuantidade() { return $this->quantidade; }
    function setQuantidade( $quantidade ) { $this->quantidade = $quantidade; }

    function getPreco() { return $this->preco; }
    function setPreco( $preco ) { $this->preco = $preco; }

}

?>