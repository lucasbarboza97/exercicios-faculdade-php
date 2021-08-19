<?php

class Carro{
        // modelo (texto), rpm (número de rotações por minuto), marcha (número), velocidadeEmKm (número) e ligado (que indica se o carro está ligado ou não).
        private $modelo;
        private $rpm = 0;
        private $marcha = 0;
        private $velocidadeEmKm = 0;
        private $ligado = false;


        // Construtor
        public function __construct( $modelo ) {
                $this->modelo=$modelo;
        }
        
        
        // Getters and Setters
        public function getModelo() {
            return $this->modelo;
        }
        
        public function getrpm() {
            return $this->rpm;
        }
        
        public function getMarcha() {
            return $this->marcha;
        }
        
        public function getVelocidadeEmKm() {
            return $this->velocidadeEmKm;
        }
        
        public function getLigado() {
            return $this->ligado;
        }



        // Funções
        public function acelerar(){
            if($this->rpm<=6000){
                $this->rpm+=200;
            }
            if($this->marcha == -1){
                $this->velocidadeEmKm+=10;
            }
            else if($this->marcha != 0){
                $this->velocidadeEmKm+=10*$this->marcha;
            }
        }

        public function desacelerar(){
            if($this->rpm>=0){
                $this->rpm-=200;
            }
            if($this->marcha == -1){
                $this->velocidadeEmKm-=10;
            }
            else if($this->marcha != 0){
                $this->velocidadeEmKm-=10*$this->marcha;
            }
        }

        public function passarMarcha($marchaDesejada){
            if((($marchaDesejada == -1 and $this->marcha == 0)  or ($marchaDesejada == -1 and $this->marcha == 1 and $this->rpm<2000)) or $marchaDesejada == 0 or $marchaDesejada == 1 or $marchaDesejada == 2 or $marchaDesejada == 3 or $marchaDesejada == 4 or $marchaDesejada == 5){
                $this->marcha = $marchaDesejada;
            }
            else if($marchaDesejada != -1 or $marchaDesejada != 0 or $marchaDesejada != 1 or $marchaDesejada != 2 or $marchaDesejada != 3 or $marchaDesejada != 4 or $marchaDesejada != 5){
                throw new RuntimeException('Marcha não suportada.');                          
            }else if(($marchaDesejada == -1 and $this->marcha != 0)  or ($marchaDesejada == -1 and $this->marcha != 1) or ($marchaDesejada == -1 and $this->marcha == 1 and $this->rpm>=2000)){
                throw new RuntimeException('A caixa de marcha foi forçada. Engate ponto morto e repita a operação.');
            }
        }

        public function subirMarcha(){
            if($this->marcha <= 5){
                $marcha = $this->marcha+1;
                $this->passarMarcha($marcha);
            }
        }
        public function descerMarchar(){
            if($this->marcha >= -1){
                $marcha = $this->marcha - 1;
                $this->passarMarcha($marcha);
            }
        }

        public function ligar(){
            try{
                if($this->ligado==false and $this->marcha==0){
                    $this->ligado=true;
                    $this->rpm=100;
                }
            }catch(RuntimeException $e){
                echo 'Coloque o carro em ponto morto e tente novamente: ', $e->getMessage();
            }

        }

        public function desligar(){
            $this->ligado=false;
        }
    }


    class Corrida{      
        private $listaDeCarros;

        public function __construct( $listaDeCarros ) {
            $this->listaDeCarros=$listaDeCarros;
        }


        public function iniciar (){
            echo "A corrida iniciou, esses são os modelos de carros competindo: ",PHP_EOL;
            foreach($this->listaDeCarros as $carro){
                $carro->ligar();
                $carro->subirMarcha();
                $carro->acelerar();      
                echo $carro->getModelo(),PHP_EOL;  
            }
            for($rodada=1;$rodada<=100;$rodada++){
                $carroAleatorio = array_rand ($this->listaDeCarros);
                $this->listaDeCarros[$carroAleatorio]->acelerar;
                var_dump($this->listaDeCarros);
            }
        }
    }


    $uno = new Carro('UNO');
    $celta = new Carro('Celta');
    $corsa = new Carro('Corsa');
    $hb20 = new Carro('HB20');
    $chevette = new Carro('Chevette');
    
    $carros = [$uno,$celta,$corsa,$hb20,$chevette];
    
    $corridaDeCarros = new Corrida($carros);
    $corridaDeCarros->iniciar();

    // var_dump($carros);
?>