<?php
namespace acme;

trait Nomeavel {

    private $nome;

    function getNome() { return $this->nome; }
    function setNome( $nome ) { $this->nome = $nome; }
}