<?php
include("database.class.php");

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
//conectar ao banco de dados
$bd = new mysql();
$senha = md5($senha);
echo $senha;

$get_user = "SELECT * fROM tab_admin WHERE usuario = '$usuario' AND senha = '$senha'";

$resultado = mysqli_query($bd->conectar(),$get_user);

  if(!$dados_admin = mysqli_fetch_array($resultado)){
      echo "ERRO: USUARIO INCORRETO!";
  }else{
    header("Location:../dashboard.html");
  }








?>
