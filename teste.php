<?php
class Funcionario {

    private  $nome;
    private  $cpf;
    private  $salario;

    public function calculaBonus() {
        return $this->salario * 0.10;
    }
}

class Gerente extends Funcionario {

    public function calculaBonus() {
        return $this->salario * 0.20;
    }
}

$gerente = new Gerente();
$gerente->salario = 1000;
echo $gerente->calculaBonus();
?>