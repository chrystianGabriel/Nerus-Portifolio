<?php

  class UploadArquivos{

    static public function uploadAudios($nome_temporario){
        $extensao = substr($nome_temporario,(strlen($nome_temporario) - strpos($nome_temporario,"*"))*-1);
        $extensao = substr($extensao,(strlen($extensao) - strpos($extensao,"."))*-1);
        
        
        $caminho_temporario = substr($nome_temporario,0,strpos($nome_temporario,"*"));
        $caminho_novo = "../upload/"  .substr(md5($caminho_temporario),10) .$extensao;
       
        
        move_uploaded_file($caminho_temporario,$caminho_novo);
        return  $caminho_novo;
    }

    static public function uploadImagens($nome_temporario){
      $extensao = substr($nome_temporario,(strlen($nome_temporario) - strpos($nome_temporario,"*"))*-1);
      $extensao = substr($extensao,(strlen($extensao) - strpos($extensao,"."))*-1);
      $caminho_temporario = substr($nome_temporario,0,strpos($nome_temporario,"*"));
      $caminho_novo = "../upload/"  .substr(md5(rand(0,1000) * time()),10) .$extensao;
      move_uploaded_file($caminho_temporario,$caminho_novo);
      return $caminho_novo;
    }
    static public function uploadAvatar($nome_temporario){
      $extensao = substr($nome_temporario,(strlen($nome_temporario) - strpos($nome_temporario,"*"))*-1);
      $extensao = substr($extensao,(strlen($extensao) - strpos($extensao,"."))*-1);

      $caminho_temporario = substr($nome_temporario,0,strpos($nome_temporario,"*"));
      $caminho_novo = "../upload/"  .substr(md5(rand(0,1000) * time()),0,10) .$extensao;
      move_uploaded_file($caminho_temporario,$caminho_novo);
      return $caminho_novo;

    }

    static public function deletarAvatar($caminho_avatar){
        unlink($caminho_avatar);
    }
     static public function deletarImagem($caminho_imagem){
        unlink($caminho_imagem);
    }

    static public function deletarAudio($caminho_audio){
        unlink($caminho_audio);
    }
  }



?>
