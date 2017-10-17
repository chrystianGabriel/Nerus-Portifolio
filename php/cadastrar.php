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

    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="text-align:center;">

        <?php
          include("dao-locutor.class.php");
          include("upload-arquivos.class.php");
          
         //evita que apareça erros na tela

        //******************************
        //**Verifica se nao houve erro**
        //******************************
          $erro = sizeof($_FILES);

          if($erro){
            $locutor = new Locutores();
            $daoLocutor = new daoLocutores();

            if(isset($_POST['codigo'])){
              $daoLocutor->removeLocutor($_POST['codigo']);
            }
          
            //Set da atributos mono valorador
            $locutor->setNome($_POST["input_nome"]);

            $locutor->setTipo($_POST["tipo_locucao"]);

            $locutor->setDescricao($_POST["textarea_descricao"]);

            $locutor->setCEP($_POST['cep']);

            $locutor->setAvatar($_FILES["avatar"]["tmp_name"] ."*".$_FILES["avatar"]["name"]);

            //Set de atributos multivalorados

            //****************************************
            
            //Salva o caminho temporario de cada audio
            for($i = 0; $i < sizeof($_FILES["audios"]["tmp_name"]) - 1;$i++){
                 $nome_temp = $_FILES["audios"]["tmp_name"];
                 $extensao = $_FILES["audios"]["name"];
                 $locutor->setAudios($nome_temp[$i] ."*".$extensao[$i]);
            }

            //salva o caminho temporario de cada imagem
            for($i = 0; $i < sizeof($_FILES["imagem"]["tmp_name"]) - 1;$i++){
                 $nome_temp = $_FILES["imagem"]["tmp_name"];
                 $extensao = $_FILES["imagem"]["name"];
                 $locutor->setImagens($nome_temp[$i] ."*".$extensao[$i]);
            }

            //salva o caminho de cada video
            for($i = 0; $i < sizeof($_POST["videos"]);$i++){
                 $nome = $_POST["videos"][$i];
                 $locutor->setVideos($nome);
            }



         //****************************************
         //O avatar é feito upload primeiro, pois é
         // o unico atributo que envolve aquivos que
         //é monovalorado!*************************
         //****************************************
          $novo_caminho  = UploadArquivos::uploadAvatar($locutor->getAvatar());
          $locutor->setAvatar($novo_caminho);





         //****************************************
         //**********Codigo do locutor*************
         //****************************************

         $codigo_locutor = $daoLocutor->salvarLocutor($locutor);

         // salvar nota do locutor
         $daoLocutor->salvarAvaliacao($codigo_locutor,$_POST['nome_avaliacao'],$_POST['nota'],$_POST['comentario_avalicao']);
            //upload de tags
            //Salva as Tags do locutor
            

            for ($i=0; $i <sizeof($_POST['tags_locutor']) ; $i++) { 

                $daoLocutor->salvarTags($codigo_locutor,$_POST['tags_locutor'][$i]);

                
            }
          
            if($locutor->getTipo() == 1){
              //Fazer  upload imagens
               for($i = 0; $i < sizeof($_FILES["imagem"]["tmp_name"]) - 1;$i++){
                 $novo_caminho = UploadArquivos::uploadImagens($locutor->getImagens($i));
                 $daoLocutor->salvarImagens($novo_caminho,$codigo_locutor);
               }
              //Salvar url dos videos no bd
             
              for($i = 0; $i < sizeof($_POST["videos"]);$i++){
               
                $daoLocutor->salvarVideos($locutor->getVideos($i),$codigo_locutor);

              }
            }


            //fazer upload de audios
            for($i = 0; $i < sizeof($_FILES["audios"]["tmp_name"]) - 1;$i++){
              $nome_audio = substr($locutor->getAudios($i),(strlen($locutor->getAudios($i)) - strpos($locutor->getAudios($i),"*"))*-1);
              $nome_audio = str_replace("*","",$nome_audio);
              $novo_caminho = UploadArquivos::uploadAudios($locutor->getAudios($i));
              $daoLocutor->salvarAudios($nome_audio,$novo_caminho,$codigo_locutor);

            }
            $id = "sucesso";
            echo "<header id='$id'>
                <label>ツ</label>
                <h2>O cadastro ocorreu com sucesso! o que deseja fazer agora?</h2>
                <h5>Caso nenhuma ação ocorra você será redirecionado em alguns segundos!</h5>
            </header>";

            echo "<a href='../cadastrar.html' class='btn btn-lg btn-success' style='margin-top:50px; margin-left: 20px'>Cadastrar Novo Locutor</a>";
            echo "<a href='listagem.php' class='btn btn-lg btn-warning' style='margin-top:50px; margin-left: 20px''>Visualizar Locutores Cadastrados</a>";
            echo "<script>setTimeout(function(){location.href='listagem.php'},10000);</script>";



          }else{
            $id = "erro";
            echo "<header id='$id'>
                <label>:(</label>
                <h2>Ops!houve algum erro, por favor tente novamente.</h2>
            </header>";

            echo "<script>setTimeout(function(){location.href='../cadastrar.html'},5000);</script>";
          }
        ?>






    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
