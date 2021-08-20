<?php

// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //
// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //
// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //
// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //
// Classe carro
class Carro{
        // modelo (texto), rpm (número de rotações por minuto), marcha (número), velocidadeEmKm (número) e ligado (que indica se o carro está ligado ou não).
        protected $modelo;
        protected $rpm = 0;
        protected $marcha = 0;
        protected $velocidadeEmKm = 0;
        protected $ligado = false;


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


// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //
// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //
// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //
// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //
// Classe carro esportivo
class CarroEsportivo extends Carro{

    // Funções
    public function acelerar(){
        if($this->rpm<=8000){
            $this->rpm+=300;
        }
        if($this->marcha == -1){
            $this->velocidadeEmKm+=20;
        }
        else if($this->marcha != 0){
            $this->velocidadeEmKm+=20*$this->marcha;
        }
    }

    public function desacelerar(){
        if($this->rpm>=0){
            $this->rpm-=300;
        }
        if($this->marcha == -1){
            $this->velocidadeEmKm-=20;
        }
        else if($this->marcha != 0){
            $this->velocidadeEmKm-=20*$this->marcha;
        }
    }

    public function subirMarcha(){
        if($this->marcha <= 7){
            $marcha = $this->marcha+1;
            $this->passarMarcha($marcha);
        }
    }
}



// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //
// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //
// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //
// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //
// Classe corrida
class Corrida{
    
    // Atributos
    private $listaDeCarros;
    private $colocacao;
    private $velocidadeTotal = [0];

    // Construtor
    public function __construct( $listaDeCarros ) {
        $this->listaDeCarros=$listaDeCarros;
    }

    // Funções
    public function iniciar (){

        // A corrida é iniciada
        echo "A corrida iniciou, esses são os modelos de carros competindo: ",PHP_EOL;
        foreach($this->listaDeCarros as $carro){
            $carro->ligar();
            $carro->subirMarcha();
            $carro->acelerar();      
            echo $carro->getModelo(),PHP_EOL;
        }

        // Rodadas da corrida
        for($rodada=1;$rodada<=100;$rodada++){

            // Rodada iniciada
            echo PHP_EOL, PHP_EOL, PHP_EOL, "Rodada ", $rodada, PHP_EOL, PHP_EOL;
            
            $carroAleatorio100 = array_rand ($this->listaDeCarros);
            $this->listaDeCarros[$carroAleatorio100]->acelerar();
            echo $this->listaDeCarros[$carroAleatorio100]->getModelo(), " acelerou!", PHP_EOL;
            
            if($rodada % 2 == 0){
                $carroAleatorio50 = array_rand ($this->listaDeCarros);    
                // if($this->listaDeCarros[$carroAleatorio50]->getMarcha()<5)
                try{
                    $this->listaDeCarros[$carroAleatorio50]->subirMarcha();
                    echo $this->listaDeCarros[$carroAleatorio50]->getModelo(), " subiu uma marcha!", PHP_EOL;
                }catch(RuntimeException $re){
                    echo $this->listaDeCarros[$carroAleatorio50]->getModelo(), " não teve sua marcha alterada! ", $re->getMessage(), PHP_EOL;
                }
            }

            if($rodada % 4 == 0){
                $carroAleatorio25 = array_rand ($this->listaDeCarros);
                $this->listaDeCarros[$carroAleatorio25]->desacelerar();
                echo $this->listaDeCarros[$carroAleatorio25]->getModelo(), " desacelerou!", PHP_EOL;
            }

            if($rodada % 10 == 0){
                $carroAleatorio25 = array_rand ($this->listaDeCarros);
                $this->listaDeCarros[$carroAleatorio25]->descerMarchar();
                echo $this->listaDeCarros[$carroAleatorio25]->getModelo(), " diminuiu uma marcha!", PHP_EOL;
            }
            
            /* Exibe a cada rodada, a velocidade que o carro está e acrescenta num array velocidade total 
                para que seja contabilizado quem correu mais em KM e no final da corrida exibe o vencedor*/
            $cont = 0;
            foreach($this->listaDeCarros as $carroCorrida){
                $this->velocidadeTotal[$cont] += $carroCorrida->getVelocidadeEmKm();
                $this->colocacao [$cont] = ["Velocidade total" => $this->velocidadeTotal[$cont], "Modelo"=>$carroCorrida->getModelo()];
                $cont++;
                echo $carroCorrida->getModelo(), " esta com a velocidade de: ", $carroCorrida->getVelocidadeEmKm(), " KM. Na marcha: ", $carroCorrida->getMarcha(), ". Com o RPM de: ", $carroCorrida->getrpm(), PHP_EOL;
            }
            echo PHP_EOL, "Fim da rodada ", $rodada;
        }

        // Fim da corrida e exibe o vencedor
        echo " e fim da corrida. ";
        sort($this->colocacao);
        foreach($this->colocacao as $teste){
            $vencedor = $teste['Modelo'];
        }
        echo PHP_EOL,"O vencedor da corrida, é: ", $vencedor;
    }
}




// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //
// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //
// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //
// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //

// Corrida de carros normais.
$uno = new Carro('UNO');
$celta = new Carro('Celta');
$corsa = new Carro('Corsa');
$hb20 = new Carro('HB20');
$chevette = new Carro('Chevette');
$carros = [$uno,$celta,$corsa,$hb20,$chevette];
$corridaDeCarros = new Corrida($carros);
// $corridaDeCarros->iniciar();

// Corrida de carros esportivos.
$ferrari = new CarroEsportivo('Ferrari');
$lamborghini = new CarroEsportivo('Lamborghini');
$unoComEscada = new CarroEsportivo('Uno com escada');
$porsche = new CarroEsportivo('Porsche');
$lotus = new CarroEsportivo('Lotus');
$carrosEsportivos = [$ferrari,$lamborghini,$unoComEscada,$porsche,$lotus];
$corridaDeCarrosEsportivos = new Corrida($carrosEsportivos);
$corridaDeCarrosEsportivos->iniciar();
?>