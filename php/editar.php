<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Nerus Admin</title>

  <!-- Bootstrap -->
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!--CSS-->
  <link href="../css/cadastrar.css" rel="stylesheet"/>
  <link href="../css/menu.css" rel="stylesheet"/>
  <!--JS-->

  <script type="text/javascript" src="../js/editar.js"></script>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>
    <body onload="mudarTipoLocutor()">
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <a class="navbar-brand" id="titulo"><strong>N e r u s &nbsp &nbspL o c u ç õ e s</strong></a>

          </div>
        </div>
        <div>
          <ul class="nav navbar-nav navbar-right hidden-xs">
            <li class="item-menu">
            <label class="texto-menu"><a href="../dashboard.html">Inicio</a></label>
            </li>
            <li class="item-menu">
              <label class="texto-menu"><a href="listagem.php">Locutores</a></label>
            </li>


            <li class="item-menu">
              <a class="texto-menu" id="botao-sair" href="../index.html">Sair</a>
            </li>
          </ul>
        </div>

      </nav>
      <section id="cadastro">
        <div class="container">
          <div class="row">
            <header class="col-md-12 col-xs-12">
              <label>Editar Locutor</label>
            </header>
          </div>

          <hr />

          <div class="row">
            <form id="form-cadastro" role="form" action="salvar-alteracoes.php"method="post" enctype="multipart/form-data">
              <input onchange="previewAvatar()" name="avatar" type="file" id="input-img" accept="image/*" />
              <input type="text" class="hidden" id="status-avatar" name="avatar">
              <span  id="mascara-input" ><label class="glyphicon glyphicon-plus"></label></span>
              <img  class="img img-responsive" id="img-avatar"/>
              <select name="tipo_locucao" id="tipo-locucao" onchange="mudarTipoLocutor()" >
                <option value="1">1-Locução Presencial</option>
                <option value="2">2-Locução Remota</option>
               
              </select>

              <input name="input_nome" type="text" placeholder="Nome" id="input-nome"/>

              <textarea name="textarea_descricao"  placeholder="Insira a Descrição aqui!" id="textarea-descricao"></textarea>

              <div id="tags">
                <div class="row">
                  <div class="container">
                    <div class="col-md-12">
                      <span class="glyphicon glyphicon-shopping-cart"></span>
                      <label>Tipos de Revendas</label>
                     
                    </div>

                    <input type="checkbox" value="hipermercado" name="tags_locutor[]" id="tipo_locucao1">
                    <label for="tipo_locucao1">hipermercado</label>

                    <input type="checkbox" value="mercado" name="tags_locutor[]" id="tipo_locucao2">
                    <label for="tipo_locucao2">super mercado</label>

                    <input type="checkbox" value="via_varejo" name="tags_locutor[]" id="tipo_locucao3">
                    <label for="tipo_locucao3">via varejo</label>

                    <input type="checkbox" value="confecção" name="tags_locutor[]" id="tipo_locucao4">
                    <label for="tipo_locucao4">confecção</label>

                    <input type="checkbox" value="açougue" name="tags_locutor[]" id="tipo_locucao5">
                    <label for="tipo_locucao5">açougue</label>

                    <input type="checkbox" value="postos_de_combustíveis" name="tags_locutor[]" id="tipo_locucao6">
                    <label for="tipo_locucao6">postos de combustíveis</label>









                   
                  </div>

                </div>


              <div id="endereço">
                <div class="row">
                  <div class="container">
                    <div class="col-md-12">
                      <span class="glyphicon glyphicon-home"></span>
                      <label>Localização</label>
                      <hr>
                    </div>

                    <input placeholder="Digite o CEP" onkeyup="validarCEP(this)" id="input-cep" name='cep'/>

                    <label class="glyphicon glyphicon-remove" id="cep-erro"/>

                    <hr>
                  </div>

                </div>


              </div>

              <?php

              include("dao-locutor.class.php");
              $locutores  = new daoLocutores();

              if(isset($_GET['editar'])){
                $codigo = $_GET['editar'];
                $tipo = $_GET['tipo']-1;
                $locutor = $locutores->getLocutor($codigo);
                $audios_locutor = $locutores->getLocutorAudios($codigo);
                $tags_locutor = $locutores->getLocutorTags($codigo);
                $descricao  = str_replace("\n","<br>",$locutor['descricao']);
                $descricao  = str_replace("\r","<br>", $descricao);
                /*===================================================*/
                /* Insere os dados genericos para todos os locutores*/
                /*===================================================*/

                echo "<script>setAvatar('$locutor[avatar]')</script>";
                echo "<script>setTipo($tipo)</script>";
                echo "<script>setNome('$locutor[nome]')</script>";
                echo "<script>setDescricao('$descricao')</script>";
                echo "<script>setCEP('$locutor[cep]')</script>";

                for ($i=0; $i < sizeof($tags_locutor) ; $i++) { 
                    $tag = $tags_locutor[$i]['tag_locutor'];
                    echo "<script>setTags('$tag')</script>";
                }

                /*=========================================================*/
                /* Insere os dados genericos para os locutores de tipo 1 e 2*/
                /*==========================================================*/
                if($tipo == 0){
                  $imagens = $locutores->getLocutorImagens($codigo);

                  echo   '<div id="imagens">
                  <div class="row">
                    <div class="container">
                      <div class="col-md-12">
                        <span class="glyphicon glyphicon-camera"></span>
                        <label>Imagens</label>
                        <hr />
                      </div>
                    </div>
                  </div>
                  <div id="adiciona-imagem">';

                   for($i = 0; $i < sizeof($imagens);$i++){
                    echo ' <div class="add-img">
                    <input onchange="previewImagens(this.parentNode.children[2].src,this)" name="imagens[]" type="file" id="input-img"="true" accept="image/*" />
                    <span  id="mascara-input"><label class="glyphicon glyphicon-plus"></label></span>
                    <img  class="img img-responsive thumbnail img-preview"/>
                    <div class="deletar-imagem" onclick="deletarImagem(this)">
                      <button class="btn btn-lg" type="button" id="botao-deletar-imagens"><span class="glyphicon glyphicon-trash"></span></button>
                    </div>
                    <input type="text" class="hidden img-estado" name="imagens[]" />
                  </div>';

                  $aux = $imagens[$i]['caminho_imagens'];
                  echo "<script>setImagem('$aux')</script>";

                }
                echo ' <div class="add-img">
                <input onchange="previewImagens(this.parentNode.children[2].src,this)" name="imagens[]" type="file" id="input-img"="true" accept="image/*" />
                <span  id="mascara-input"><label class="glyphicon glyphicon-plus"></label></span>
                <img  class="img img-responsive thumbnail img-preview"/>
                <div class="deletar-imagem" onclick="deletarImagem(this)">
                  <button class="btn btn-lg" type="button" id="botao-deletar-imagens"><span class="glyphicon glyphicon-trash"></span></button>
                </div>
                <input type="text" class= "hidden img-estado" name="imagens[] "/>
              </div>';

              echo '</div>';
              echo "</div>";




            }

            if($tipo == 0){
             $videos = $locutores->getLocutorVideos($codigo);


             echo ' <div id="videos">
             <div class="row">
              <div class="container">
                <div class="col-md-12">
                  <span class="glyphicon glyphicon-facetime-video" style="margin-top: 50px;"></span>
                  <label>Videos</label>
                  <hr />
                </div>
              </div>
            </div>

            <div id="adiciona-videos">';
              for($i = 0; $i < sizeof($videos);$i++){
                echo '<div class="add-videos">
                <input type="url" name="videos[]" placeholder="Coloque a URL do vídeo Aqui"="true"  class="input-videos"/>
                <button type="button" class="btn btn-lg" id="botao-adicionar-videos" onclick="adicionarVideos(this)"><span class="glyphicon glyphicon-plus"></span></button>
                <button type="button" class="btn btn-lg" id="botao-deletar-videos" onclick="deletarVideos(this)"><span class="glyphicon glyphicon-trash"></span></button>
              </div>';
              $aux = $videos[$i]['caminho_videos'];      
              echo "<script>setVideo('$aux')</script>";
            }   

            echo '<div class="add-videos">
            <input type="url" name="videos[]" placeholder="Coloque a URL do vídeo Aqui"="true"  class="input-videos"/>
            <button type="button" class="btn btn-lg" id="botao-adicionar-videos" onclick="adicionarVideos(this)"><span class="glyphicon glyphicon-plus"></span></button>
            <button type="button" class="btn btn-lg" id="botao-deletar-videos" onclick="deletarVideos(this)"><span class="glyphicon glyphicon-trash"></span></button>
          </div>';

          echo '</div>';  
          echo '</div>'; 
        }



      } 



      /*==================================================================*/
      /* Insere os audios pois é generico para todos os tipos de locutores*/
      /*==================================================================*/

      echo '  <div class="row">
      <div class="container">
        <div class="col-md-12">
          <span class="glyphicon glyphicon-volume-up" style="margin-top: 50px;"></span>
          <label>Audios</label>
          <hr />
        </div>
      </div>
    </div>

    <div id="adiciona-audios">
      <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />';

      for($i = 0; $i < sizeof($audios_locutor);$i++){
        $caminho_audio = $audios_locutor[$i]['caminho_audio'];
        echo "<script>var caminho = '$caminho_audio'</script>";
        echo "<div class='add-audios'>
        <input type='text' id='audio-name' disabled placeholder='Nenhum audio Adicionado' class='input-audios'/>
        <input type='file' name='audios[]' accept='audio/*' id='input-audio'  onchange='adicionarAudios(this)' />
        <button type='button' id='adiciona-audio' class='btn btn-lg'><span class='glyphicon glyphicon-plus'></span></button>
        <button type='button' id='remove-audio' class='btn btn-lg' onclick='removerAudio(this,a)'><span class='glyphicon glyphicon-trash'></span></button>
        <input type='text' class= 'hidden img-estado' name='audios[]'/>

      </div>";

      $aux = $audios_locutor[$i]['nome'];

      echo "<script>setAudio('$aux')</script>";
    }    
    echo  "<div class='add-audios'>
    <input type='text' id='audio-name' disabled placeholder='Nenhum audio Adicionado' class='input-audios'/>
    <input type='file' name='audios[]' accept='audio/*' id='input-audio'  onchange='adicionarAudios(this)' />
    <button type='button' id='adiciona-audio' class='btn btn-lg'><span class='glyphicon glyphicon-plus'></span></button>
    <button type='button' id='remove-audio' class='btn btn-lg' onclick='removerAudio(this,'$caminho_audio')'><span class='glyphicon glyphicon-trash'></span></button>
    <input type='text' class= 'hidden img-estado' name='audios[]'/>

  </div>";      

  echo '</div>';

  echo "<input type='text' value='$codigo' name='codigo' class='hidden'/>";








  ?>

  <a class="btn btn-lg btn-danger" id="botao-cancelar" href="listagem.php">Cancelar</a>
  <button class="btn btn-lg btn-success" id="botao-enviar" type="submit">Salvar alterações</button>
</form>


</div>

</section>    




<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
