<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Link para arquivos CSS-->
  <link rel="stylesheet" href="../css/estilos-globais.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link rel="stylesheet" href="../icones/css/font-awesome.min.css">
   <style>
  


  .descricao{

    width: 100%;
    height: 300px;
    margin-top: 10px;
    padding: 10px;
    border-color: transparent;
    border-top-color: #FD6703;
    background: transparent;
    color: white;
  }
  
  
  .player-background{
     background: white;
     width: 400px;
     

    
     



  }
  
  .player-audio{
   
   float: right;
   margin-top: 30px;

   
   
  }
  .player-item{
    
    
    color: #2e2e2e;
    margin:0;
    font-weight: bold;
  }

  ::-webkit-input-placeholder{
    color: black;
  }
  ::-moz-placeholder{
    color: black;
  }
  ::-ms-placeholder{
    color: black;
  }
  ::-o-placeholder{
    color: black;
  }

</style>

 
<script type="text/javascript">
  function tocarAudio(caminho_audio,icone_tocando){

  let audio = document.getElementsByClassName('player-audio');
  let icones = document.getElementsByClassName('fa-circle');
  let icone = icone_tocando.children[0];

  audio[0].src = caminho_audio;
  audio[0].play();

  for (var i = icones.length - 1; i >= 0; i--) {

    icones[i].style.color = "#2E2E2E";
  }
  icone.style.color = "#5cb85c";
  console.log(icone);

    

 }

</script>

<script type="text/javascript" src='../js/validacoes.js'></script>
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
          <a class="nav-link" href="../home.html">Home <span class="sr-only">(current)</span></a>
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
  
  <section id="locutor_perfil">
    <div class="container content">
      <div class="row">
        <div class="col-xs-12 col-sm-12">
          <header class="titulo">Perfil Do Locutor</header>
        </div>

        <?php
        include("dao-locutor.class.php");

        if(isset($_GET['codigo'])){

         $daoLocutor = new daoLocutores();
         $locutor = $daoLocutor->getLocutor($_GET['codigo']);
         $audios = $daoLocutor->getLocutorAudios($_GET['codigo']);
         $imagens = $daoLocutor->getLocutorImagens($_GET['codigo']);
         $videos = $daoLocutor->getLocutorVideos($_GET['codigo']);
         $avalicoes = $daoLocutor->getAvaliacoes($_GET['codigo']);





            // imprime o avatar do locutor
         echo "<div class='col-sm-4 col-xs-4'>
         <img class='img-thumbnail' src='$locutor[avatar]' style='height:300px;'>

         </div>";
         echo "<div class='col-sm-6 col-xs-6'>
         <h2>$locutor[nome]</h2>
         <textarea class='descricao' disabled>$locutor[descricao]</textarea>
         </div>";

         echo "<div class='col-sm-12 col-xs-12'>
         <header class='titulo'><h3><i class='fa fa-microphone' style='color:#FD6703'></i> Audios</h3></header>
         </div>";

            // imprime os audios do locutor
        $audio = $audios[0];
        echo "<div class='col-sm-12 col-xs-12'>
              <div class='player-background centralizar'>
                <img src='../img/icon.png' alt='' class='thumbnail' width='100px'>
                <audio src='$audio[caminho_audio]' class='player-audio' controls></audio>
                <div><label style='color:black' class='player-item' onclick=tocarAudio('$audio[caminho_audio]',this)>$audio[nome]&nbsp;&nbsp;&nbsp;<i class='fa fa-circle' style='color:#5cb85c'></i><label></div>";

        for($i = 1;$i < sizeof($audios);$i++){

           $audio = $audios[$i];

           echo "<div><label style='color:black' class='player-item' onclick=tocarAudio('$audio[caminho_audio]',this)>$audio[nome]&nbsp;&nbsp;&nbsp;<i class='fa fa-circle' style='color:#2e2e2e'></i><label></div>";
        }

        echo " </div>
            </div>";
       

            // imprime as imagens do locutor

        echo "<div class='col-sm-12 col-xs-12'>
        <header class='titulo'><h3><i class='fa fa-picture-o' style='color:#FD6703'></i> Imagens</h3></header>
        </div>
        <div id='carouselExampleControls' class='carousel slide' data-ride='carousel'>
        <div class='carousel-inner'>";
        $imagem = $imagens[0];

        echo "<div class='carousel-item active'>
        <img class='d-block w-100' src='$imagem[caminho_imagens]' alt='First slide'>
        </div>";

        for($i = 1; $i < sizeof($imagens);$i++){
          $imagem = $imagens[$i];
          echo " <div class='carousel-item'>
          <img class='d-block w-100' src='$imagem[caminho_imagens]' alt='First slide'>
          </div>";

        }
        echo '</div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
        </div>';

            // imprime os videos do locutor
        echo "<div class='col-sm-12 col-xs-12'>
        <header class='titulo'><h3><i class='fa fa-picture-o' style='color:#FD6703'></i> Videos</h3></header>
        </div>";

        for($i = 0; $i < sizeof($videos);$i++){
          $video = $videos[$i];
          $video = "https://www.youtube.com/embed/" .substr($video['caminho_videos'],strpos($video['caminho_videos'],"?v=") + 3);

          echo "<div class='col-sm-12 col-xs-1'>
          <div>
          <iframe width='100%' height='400' src='$video'>
          </iframe>
          </div>
          </div>"; 
        }

        echo "<div class='col-sm-12 col-xs-12'>
        <header class='titulo'><h3><i class='fa fa-star' style='color:#FD6703'></i> Avaliações</h3></header>
        </div>";

        if(sizeof($avalicoes) > 9){
          $tamanho  = 9;
        }else{
          $tamanho = sizeof($avalicoes);
        }

        for($i = $tamanho - 1; $i  > -1;$i--){
          $avaliacao = $avalicoes[$i];
          $nota = round($avaliacao['nota'],0);
          echo "<div class='col-sm-12 col-xs-12' >

          <h4 class='card-title' style='color:black'>$avaliacao[nome]&nbsp;&nbsp;" ;

          for ($j=0; $j < 5; $j++) { 

            if($j < $nota){
             echo "<i class='fa fa-star' style='color:#FD6703;' aria-hidden='true'></i>";
           }else{
             echo "<i class='fa fa-star' style='color:#9f9f9f;' aria-hidden='true'></i>";
           }
         }


         echo " </h4> <p class='card-text' style='color:white' >$avaliacao[comentario]</p>
          </div>";
       }





     }


     ?>

     <div class="col-sm-12 col-xs-12" align="right" >
      <button class="btn btn-lg btn-success" data-toggle="modal" data-target="#modalContratar" style='margin-top:20px' data-whatever="@mdo">Contratar</button>
      
     


    </div>
  </div>
  

    
</div>


</div>



</section>


<!-- Modal para coleta de dados -->
<div class="modal fade" id="modalContratar" tabindex="-1" role="dialog" aria-labelledby="modalCastingLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" >
    <div class="modal-content" style="background:#2e2e2e">
      <div class="modal-header" style="background:#2e2e2e">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="contratar.php">
          <div class="row">
             <div class="col-sm-12 col-xs-12">
           <h5>Qual seu nome?</h5>
         </div>

         <div class="col-sm-12 col-xs-12">
           <label for="inputNome">Nome</label>
           <input type="text" id="inputNome" class="form-control"  name="nome">
         </div>
            <div class="col-sm-12 col-xs-12">
              <h5>Descreva sua revenda com mais detalhes!</h5>
              <textarea name='revenda_descricao' style='color:black'name="" id="" cols="50" rows="10" placeholder="Qual hipermercado ou supermercado? ex:Bretas,Carrefour,Extra e outros."></textarea>
            </div>
            <div class="col-sm-12 col-xs-12">
             <h5>Dados de contato</h5>
           </div>
           <div class="col-sm-12 col-xs-12">

            <label for="inputTelefone">Telefono ou Celular</label>
            <input type="text" id="inputTelefone" class="form-control" onchange="" name="telefone">


          </div>
         


        


       </div>
       <br>
       <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
       <input type="submit" class="btn btn-success">
     </form>

   </div>
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>


 </body>


 </html>