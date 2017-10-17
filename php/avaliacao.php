
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Link para arquivos CSS-->
  <link rel="stylesheet" href="../css/estilos-globais.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link rel="stylesheet" href="../icones/css/font-awesome.min.css">
  <style>
    ::-webkit-input-placeholder{
      color:black;
    }
    ::-moz-input-placeholder{
      color:black;
    }
    ::-ms-input-placeholder{
      color:black;
    }
    ::-o-input-placeholder{
      color:black;
    }
  </style>
  
  <!-- Importe de todos os iscripts javascript -->
  <script>
    
    function ativarEstrela(estrela){
      let estrelas = document.getElementsByClassName('fa-star');

      for(let i = 0; i < estrelas.length; i++){
          estrelas[i].style.color = 'white';
      }

      for(let i = 0; i < estrela; i++){

        estrelas[i].style.color = 'yellow';
      }
      
    }

    function salvarAlteracao(codigo){
      let estrelas = document.getElementsByClassName('fa-star');
      let comentario = document.getElementById('comentario');
      let nome = document.getElementById('nome');

      window.location.href =  window.location.href + '&nota=' + estrelas.length + '&comentario=' + comentario.value + '&nome=' + nome.value;

    }

  </script>
</head>
<body>
  <!-- menu Responsivo -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark  navbar-fixed-top">
    <a class="navbar-brand" href="home.html"><img src="../img/nerus logo.png" width="200px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="home.html">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Casting</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Trabalhe Conosco </a>
          <li class="nav-item">
            <a class="nav-link" href="#">Contato</a>
          </li>
        </li>
      </ul>
    </div>
  </nav>
  
  <section id="avaliar">
    <div class="container content">
        <?php
          include("dao-locutor.class.php");

         
          if(isset($_GET['codigo']) && !isset($_GET['nota'])){

             $daoLocutor = new daoLocutores();
             $locutor = $daoLocutor->getLocutor($_GET['codigo']);

             echo "<div class='row'>
                      <div class='col-sm-4 col-xs-4'>
                        <img class='img-thumbnail' src='$locutor[avatar]' style='width:300px'/>
                        
                      </div>

                      <div class='col-sm-6 col-xs-6'>
                        <h4>$locutor[nome]
                        </h4>
                        <i onclick='ativarEstrela(1)' class='fa fa-star'></i>
                        <i onclick='ativarEstrela(2)' class='fa fa-star'></i>
                        <i onclick='ativarEstrela(3)' class='fa fa-star'></i>
                        <i onclick='ativarEstrela(4)' class='fa fa-star'></i>
                        <i onclick='ativarEstrela(5)' class='fa fa-star'></i>
                        <div>
                           <input id='nome' placeholder='digite seu nome' style='margin:10px 0px;color:black'>
                        </div>
                        <div>
                          
                        
                          <textarea id='comentario' cols='40' rows='5' placeholder='Deixe seu comentario' style='color:black;'></textarea>
                        </div>
                        <a class='btn btn-success' onclick='salvarAlteracao()'style='margin-top:20px'>Salvar Avaliação</a>
                        
                      </div>


                      
                  </div>";
          }else{

              $daoLocutor = new daoLocutores();

              $daoLocutor->salvarAvaliacao($_GET['codigo'],$_GET['nome'],$_GET['nota'],$_GET['comentario']);
              echo "<h3 style='color:FF6c00'>Locutor Avaliado com Sucesso, A Nerus Agradeço sua participação!<h3>";
              echo "<h5  align='center'>Você sera redirecionado em alguns segundos<h5>";

              echo "<script>setTimeout(function(){window.location.href = '../index.html'},10000)</script>";

          }
        ?>
    </div>
    </section>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>


</body>


</html