<?php
  class mysql{
    private $host;
    private $usuario;
    private $senha;
    private $bancoDeDados;
    private $conecao;
    
    function __construct(){
      // $this->host = "nerus_bd.mysql.dbaas.com.br";
      // $this->usuario = "nerus_bd";
      // $this->senha = "Leandro3906";
      // $this->bancoDeDados = "nerus_bd";
      $this->host = "localhost";
      $this->usuario = "root";
      $this->senha = "";
      $this->bancoDeDados = "nerus_bd";

    }
    function __destruct(){
      mysqli_close($this->conecao);
    }

    public function conectar(){
        //criar conexao
        $this->conecao =  mysqli_connect($this->host,$this->usuario,$this->senha,$this->bancoDeDados);

        //ajustar o charset
        mysqli_set_charset($this->conecao,'utf8');


        //verificar se houve erro
        if(mysqli_connect_errno()){
          echo 'Não foi possivel se conectar com o banco de dados:' .mysqli_connect_error();
          return NULL;
        }
        return $this->conecao;

    }


  }

?>
