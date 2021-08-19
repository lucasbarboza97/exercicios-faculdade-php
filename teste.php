<?php
    class Pessoa{
        public $nome;
        public function setNome($nome){
            $this->nome = $nome;
        }
        public function getNome(){
            return $this->nome;
        }
    }
    $pessoa = new Pessoa();
    $pessoa->setNome("Fabio");

    $arrayObjetos[] = $pessoa;
    
    $pessoa = new Pessoa();
    $pessoa->setNome("Maria");

    $arrayObjetos[] = $pessoa;

    var_dump($arrayObjetos);
?>