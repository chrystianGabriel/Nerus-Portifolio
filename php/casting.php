<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Link para arquivos CSS-->
  <link rel="stylesheet" href="../css/estilos-globais.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link rel="stylesheet" href="icones/css/font-awesome.min.css">


  <!-- Importe de todos os iscripts javascript -->
  <script type="text/javascript" src="../js/validacoes.js"></script>
</head>
<body onload="agrupar_ceps(null)">
  <!-- menu Responsivo -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark  navbar-fixed-top">
    <a class="navbar-brand" href="../home.html"><img src="../img/nerus logo.png" width="200px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="../home.html">Home<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../casting.html">Casting</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../formulario_trabalhe_conosco.html">Trabalhe Conosco </a>
          <li class="nav-item">
            <a class="nav-link" href="contato.php">Contato</a>
          </li>
        </li>
      </ul>
    </div>
  </nav>
  
  <div class="container content">
  <?php
    include('dao-locutor.class.php');
    $daoLocutor = new daoLocutores();
    $distancias = array();
    $locutores = $daoLocutor->getLocutores();
    if(sizeof($locutores) > 0){

     for($i = 0; $i < sizeof($locutores);$i++){
            
            
            $codigo = $locutores[$i]["codigo"];
            $avatar = $locutores[$i]["avatar"];
            $descricao = $locutores[$i]['descricao'];
            $nome = $locutores[$i]['nome'];
            $nota = round($locutores[$i]['nota'],0);
            echo "<div class='col-sm-4 col-xs-12'  style='margin-top:50px'>
                  <div class='card' style=' width:202px;color:black;'>
                  <img class='card-img-top' src='$avatar' style='color:black;width:200px'>
                  <div class='card-body' style='text-align:center'>
                  <h4 class='card-title' style='color:black'>$nome</h4>";
                  for ($i=0; $i < 5; $i++) { 
                       
                        if($i < $nota){
                           echo "<i class='fa fa-star' style='color:#FF6C00;' aria-hidden='true'></i>";
                         }else{
                           echo "<i class='fa fa-star' style='color:#2e2e2e;' aria-hidden='true'></i>";
                         }
                       
                    }
            
           
            echo "<a href='perfil_locutor.php?codigo=$codigo' class='btn btn-success' style='margin-top:10px;'>Ver Perfil</a>";
            echo "</div> </div> </div>";

          }
    }
    
  ?> 
  </div>

  

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>


</body>


</html