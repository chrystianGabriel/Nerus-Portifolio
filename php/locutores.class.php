<?php
  class Locutores{
    //atributos
    private $nome;
    private $tipo;
    private $descricao;
    private $avatar;
    private $imagens;
    private $videos;
    private $audios;
    private $cep;
    private $tags;

    function __construct(){
       $nome = "";
       $tipo = 1;
       $descricao = "";
       $avatar = "";
       $cep = "";
       $imagens = array();
       $videos = array();
       $audios = array();
       $tags = array();
    }

    //sets
    public function setNome($nome){
      $this->nome  = $nome;
    }

    public function setTipo($tipo){
      $this->tipo  = $tipo;
    }

    public function setDescricao($descricao){
      $this->descricao  = $descricao;
    }

    public function setAvatar($avatar){
      $this->avatar  = $avatar;
    }

    public function setImagens($imagens){
      $this->imagens[] = $imagens;
    }

    public function setTags($tags){
      $this->tags[] = $tags;
    }

    public function setVideos($videos){
       $this->videos[] = $videos;
    }

    public function setAudios($audios){
    $this->audios[] = $audios;

    }

    public function setCEP($cep){
      $this->cep = $cep;
    }
    //GETS
    public function getNome(){
      return $this->nome;
    }

    public function getTipo(){
      return $this->tipo;
    }

    public function getDescricao(){
      return $this->descricao;
    }

    public function getAvatar(){
      return $this->avatar;
    }

    public function getImagens($i){
      return $this->imagens[$i];
    }
    public function getImagensArray(){
      return $this->imagens;
    }

    public function getTags($i){
      return $this->tags[$i];
    }
    public function gettagsArray(){
      return $this->tags;
    }

    public function getVideos($i){
        return $this->videos[$i] ;
      }

    public function getAudios($i){
      return $this->audios[$i];

     }
     public function getAudiosArray(){
      return $this->audios;

     }
     public function getCEP(){
      return $this->cep;
     }
  }

?>
