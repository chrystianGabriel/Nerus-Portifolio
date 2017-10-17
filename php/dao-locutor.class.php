<?php
  include("database.class.php");
  include("locutores.class.php");
  class daoLocutores{


      function __construct(){
      }

      public function salvarLocutor(Locutores &$locutor){

          $nome = $locutor->getNome();
          $tipo = $locutor->getTipo();
          $descricao =$locutor->getDescricao();
          $avatar = $locutor->getAvatar();
          $cep = $locutor->getCEP();
          $bd = new mysql();
          $cep = str_replace("-","",$cep);

          //gera um codigo para o locutor
          $codigo = substr(md5(time()),10);
          $codigo = substr(md5($codigo .$locutor->getNome()),-10);


          $salvar_locutor = "INSERT INTO tab_locutores VALUES ('$nome','$codigo',$tipo,'$descricao','$avatar','$cep')";
            $con = $bd->conectar();
          if(!mysqli_query($con,$salvar_locutor)){
            echo "não foi possivel salvar Locutor no banco de dados" .mysqli_error($con);
          };

          return $codigo;
      }

      public function salvarAudios($nome_audio,$caminho_audios,$codigo_locutor){
          $codigo_locutor = str_replace(" ","",$codigo_locutor);
          $salvar_audios = "INSERT INTO tab_locutores_audios VALUES ('$codigo_locutor','$caminho_audios','$nome_audio')";
          $bd = new mysql();
            $con = $bd->conectar();
          if(!mysqli_query($con,$salvar_audios)){
            echo "não foi possivel salvar Audio no banco de dados" .mysqli_error($con);
          }


      }

      public function salvarImagens($caminho_imagens,$codigo_locutor){
        $codigo_locutor = str_replace(" ","",$codigo_locutor);
        $salvar_imagens = "INSERT INTO tab_locutores_imagens VALUES ('$codigo_locutor','$caminho_imagens')";
        
        $bd = new mysql();
        $con = $bd->conectar();
        if(!mysqli_query($con,$salvar_imagens)){
          echo "não foi possivel salvar Imagem no banco de dados" .mysqli_error($con);
        }
      }

      public function salvarVideos($caminho_videos,$codigo_locutor){
        $codigo_locutor = str_replace(" ","",$codigo_locutor);
        $salvar_videos = "INSERT INTO tab_locutores_videos VALUES ('$codigo_locutor','$caminho_videos')";
        $bd = new mysql();
        $con = $bd->conectar();
        if(!mysqli_query($con,$salvar_videos)){
          echo "não foi possivel salvar Video no banco de dados" .mysqli_error($con);
        }
      }

        public function salvarAvatar($caminho_avatar,$codigo_locutor){
          $salvar_avatar = "INSERT INTO tab_locutores_avatar VALUES ('$codigo_locutor','$caminho_avatar')";
          $bd = new mysql();
          $con = $bd->conectar();
          if(!mysqli_query($con,$salvar_avatar)){
            echo "não foi possivel salvar Avatar no banco de dados" .mysqli_error($con);
          }
        }

        public function salvarTags($codigo,$tag){
          $codigo = str_replace(" ", "",$codigo);
          $salvar_tag = "INSERT INTO tab_tags_locutores VALUES('$codigo','$tag')";

          $bd = new mysql();

          $con = $bd->conectar();
           if(!mysqli_query($con,$salvar_tag)){
            echo "não foi possivel salvar Avatar no banco de dados" .mysqli_error($con);
          }

        }
        public function getLocutores(){
          $comando = "SELECT codigo,nome,avatar,descricao,AVG(nota) AS nota,cep,tipo FROM tab_locutores INNER JOIN tab_tags_locutores INNER JOIN tab_locutores_avaliacoes ON tab_locutores_avaliacoes.codigo_locutor = tab_locutores.codigo GROUP BY codigo ORDER BY nota DESC LIMIT 21";

            $bd = new mysql();
            $con = $bd->conectar();
            $resultado = mysqli_query($con,$comando);
            $data = array();

           

            if(!$resultado){
              echo "não foi possivel selecionar locutor " .mysqli_error($con);
              return NULL;
            }
            while($res = mysqli_fetch_assoc($resultado)){
           
            array_push($data,array("codigo"=>$res["codigo"],
                                   "nome" => $res['nome'],
                                   "avatar" => $res['avatar'],
                                   "descricao" => $res['descricao'],
                                   "nota" => $res['nota'],
                                   "cep" => $res['cep'],
                                   "tipo" =>$res['tipo']));
          }
          
          return $data;

        }

        public function removeLocutor($codigo){
          $codigo = str_replace(" ", "",$codigo);
          $comando = "DELETE FROM tab_locutores WHERE codigo = '$codigo';";
          $comando .="DELETE FROM  tab_locutores_imagens WHERE codigo_locutor = '$codigo';";
          $comando .="DELETE FROM  tab_locutores_audios WHERE codigo_locutor = '$codigo';";
          $comando .="DELETE FROM  tab_locutores_videos WHERE codigo_locutor = '$codigo';";
          $bd = new mysql();
          $con = $bd->conectar();
          $resultado = mysqli_multi_query($con,$comando);

          if(!$resultado){
            echo "não foi possivel Deletar locutor " .mysqli_error($con);
            return NULL;
          }
            return $resultado;
        }

        public function getLocutor($codigo){
          $codigo = str_replace(" ", "",$codigo);
          $comando = "SELECT nome,descricao,avatar,cep FROM tab_locutores WHERE codigo = '$codigo'";
          $bd = new mysql();
          $con = $bd->conectar();
          $resultado = mysqli_query($con,$comando);

          if(!$resultado){
            echo "não foi possivel Deletar locutor " .mysqli_error($con);
            return NULL;
          }
            $data = array();
            while($aux = mysqli_fetch_assoc($resultado)){
                $data = array('nome'=> $aux['nome'],
                                        'descricao'=>$aux['descricao'],
                                        'avatar'=>$aux['avatar'],
                                        'cep'=>$aux['cep']);
            }

            return $data;

        }

        public function getLocutorImagens($codigo){
          $codigo = str_replace(" ", "",$codigo);
          $comando = "SELECT caminho_imagens FROM tab_locutores_imagens WHERE codigo_locutor = '$codigo'";

          $bd = new mysql();
          $con = $bd->conectar();
          $resultado = mysqli_query($con,$comando);

          if(!$resultado){
            echo "não foi possivel delecionar locutor " .mysqli_error($con);
            return NULL;
          }
             $data = array();
            while($aux = mysqli_fetch_assoc($resultado)){
                array_push($data,array('caminho_imagens'=>$aux['caminho_imagens']));
            }

            return $data;
        }

        public function getLocutorVideos($codigo){
          $codigo = str_replace(" ", "",$codigo);
          $comando = "SELECT caminho_video FROM tab_locutores_videos WHERE codigo_locutor = '$codigo'";
          $bd = new mysql();
          $con = $bd->conectar();
          $resultado = mysqli_query($con,$comando);

          if(!$resultado){
            echo "não foi possivel selecionar locutor " .mysqli_error($con);
            return NULL;
          }
            
            $data = array();
            while($aux = mysqli_fetch_assoc($resultado)){
                array_push($data,array('caminho_videos'=>$aux['caminho_video']));
            }

            return $data;
        }

         public function getLocutorAudios($codigo){
            $codigo = str_replace(" ", "",$codigo);
            $comando = "SELECT nome,caminho_audio FROM tab_locutores_audios WHERE codigo_locutor = '$codigo'";
            $bd = new mysql();
            $con = $bd->conectar();
            $resultado = mysqli_query($con,$comando);

            if(!$resultado){
              echo "não foi possivel selecionar locutor " .mysqli_error($con);
              return NULL;
            }
              
              $data = array();
              while($aux = mysqli_fetch_assoc($resultado)){
                  array_push($data,array('nome'=>$aux['nome'],
                                        'caminho_audio'=>$aux['caminho_audio']));
              }

              return $data;
        }

        public function getLocutorTags($codigo_locutor){
          $codigo_locutor = str_replace(" ", "",$codigo_locutor);
          $get_tags = "SELECT codigo_locutor,tag_locutor FROM tab_tags_locutores WHERE codigo_locutor = '$codigo_locutor'";
          $bd = new mysql();
          $con = $bd->conectar();
          $resultado = mysqli_query($con,$get_tags);
          $data = array();
          if(!$resultado){
              echo "Não foi possivel pegar as tags: " .mysqli_error($con);
          }

          while($res = mysqli_fetch_assoc($resultado)){
              array_push($data,array("codigo_locutor"=>$res['codigo_locutor'],
                                      "tag_locutor"=>$res['tag_locutor']));
          }

          return $data;

         
        }

        public function removerLocutorTags($codigo_locutor){
          $codigo_locutor = str_replace(" ", "",$codigo_locutor);
          $get_tags = "DELETE FROM tab_tags_locutores WHERE codigo_locutor = '$codigo_locutor'";
          $bd = new mysql();
          $con = $bd->conectar();
          $resultado = mysqli_query($con,$get_tags);
          $data = array();
          if(!$resultado){
              echo "Não foi possivel remover as tags: " .mysqli_error($con);
          }

        }

        public function updateLocutor($locutor,$codigo){
            $nome = $locutor->getNome();
            $tipo = $locutor->getTipo();
            $descricao = $locutor->getDescricao();
           
            

            $codigo = str_replace(" ", "",$codigo);
            $comando = "UPDATE  tab_locutores SET nome = '$nome', tipo = '$tipo',descricao = '$descricao' WHERE codigo = '$codigo'";
          
            $bd = new mysql();
            $con = $bd->conectar();
            $resultado = mysqli_query($con,$comando);

            if(!$resultado){
              echo "não foi possivel selecionar locutor " .mysqli_error($con);
              return NULL;
            }

       
              
              
              

            
        }

         public function removerImagens($codigo_locutor,$caminho_imagem){

             $codigo_locutor = str_replace(" ", "",$codigo_locutor);
            $comando = "DELETE FROM tab_locutores_imagens WHERE codigo_locutor = '$codigo_locutor' AND caminho_imagens = '$caminho_imagem'";

            $bd = new mysql();
            $con = $bd->conectar();
            $resultado = mysqli_query($con,$comando);

            if(!$resultado){
              echo "não foi possivel selecionar locutor " .mysqli_error($con);
              return NULL;
            }
        }


         public function removerAudios($codigo_locutor,$caminho_audio){

             $codigo_locutor = str_replace(" ", "",$codigo_locutor);
            $comando = "DELETE FROM tab_locutores_audios WHERE codigo_locutor = '$codigo_locutor' AND caminho_audio = '$caminho_audio'";
        
            $bd = new mysql();
            $con = $bd->conectar();
            $resultado = mysqli_query($con,$comando);

            if(!$resultado){
              echo "não foi possivel selecionar locutor " .mysqli_error($con);
              return NULL;
            }
        }

         public function removerVideo($codigo_locutor,$caminho_video){

             $codigo_locutor = str_replace(" ", "",$codigo_locutor);
            $comando = "DELETE FROM tab_locutores_videos WHERE codigo_locutor = '$codigo_locutor' AND caminho_video = '$caminho_video'";
        
            $bd = new mysql();
            $con = $bd->conectar();
            $resultado = mysqli_query($con,$comando);

            if(!$resultado){
              echo "não foi possivel selecionar locutor " .mysqli_error($con);
              return NULL;
            }
        }





        /**
         * [updateAvatar Atualiza o avatar do locutor]
         * @param  [string] $codigo         [Codigo do locutor na base de dados]
         * @param  [string] $caminho_avatar [caminho do avatar do locutor no servidor]
         * @return [NULL]                 [Sucesso: não e retornado nada; Erro: O erro é colocado na tela]
         */
        public function updateAvatar($codigo,$caminho_avatar){
            $codigo = str_replace(" ", "",$codigo);
            $comando = "UPDATE tab_locutores SET avatar = '$caminho_avatar' WHERE codigo = '$codigo'";
            echo $comando;
            $bd = new mysql();
            $con = $bd->conectar();
            $resultado = mysqli_query($con,$comando);

            if(!$resultado){
              echo "não foi possivel selecionar locutor " .mysqli_error($con);
              return NULL;
            }
        }

        /**
         * [filtrarLocutores Filtra os locutores de acordo com suas tags e com a distancia entre o locutor e o cliente]
         * @param  [string] $tag_locutor [tag que o cliente deseja contratar]
         * @param  [string] $cep_cliente [CEP do cleinte]
         * @return [array<locutores>]    [Sucesso:retorna o array com os locutores que se encaixam 
         *                                no filtro;
         *                                Erro: retorna todos os locutores da base de dados]
         */
        function filtrarLocutores($tag_locutor){
            $comando = "SELECT codigo,nome,avatar,descricao,AVG(nota) AS nota,cep FROM tab_locutores INNER JOIN tab_tags_locutores ON tab_tags_locutores.tag_locutor = '$tag_locutor' AND tab_tags_locutores.codigo_locutor = tab_locutores.codigo INNER JOIN tab_locutores_avaliacoes ON tab_locutores_avaliacoes.codigo_locutor = tab_locutores.codigo GROUP BY codigo ORDER BY nota DESC LIMIT 21";

            $bd = new mysql();
            $con = $bd->conectar();
            $resultado = mysqli_query($con,$comando);
            $data = array();

           

            if(!$resultado){
              echo "não foi possivel selecionar locutor " .mysqli_error($con);
              return NULL;
            }
            while($res = mysqli_fetch_assoc($resultado)){
           
            array_push($data,array("codigo"=>$res["codigo"],
                                   "nome" => $res['nome'],
                                   "avatar" => $res['avatar'],
                                   "descricao" => $res['descricao'],
                                   "nota" => $res['nota'],
                                   "cep" => $res['cep']));
          }
          
          return $data;

        }
        
        /**
         * [salvarAvaliacao description]: Salvar Avaliação do locutor
         * @param  [type] $codigo     [codigo do locutor]
         * @param  [type] $nome       [nome de cliente]
         * @param  [type] $nota       [note que o cliente deu para o locutor]
         * @param  [type] $comentario [comentario sobre o locutor]
         * @return [null]             [não há retorno]
         */
        function salvarAvaliacao($codigo,$nome,$nota,$comentario){
          $codigo_locutor = str_replace(" ","",$codigo);
          $comando = "INSERT INTO tab_locutores_avaliacoes VALUES('$codigo_locutor',$nota,'$comentario','$nome')";
          $bd = new mysql();
          $con = $bd->conectar();
          if(!mysqli_query($con,$comando)){
            echo "não foi possivel salvar avaliação no banco de dados" .mysqli_error($con);
          }




        }



        function getAvaliacoes($codigo){
          $codigo_locutor = str_replace(" ","",$codigo);
          $comando = "SELECT * FROM tab_locutores_avaliacoes WHERE codigo_locutor = '$codigo_locutor'";
           $bd = new mysql();
          $con = $bd->conectar();
          $resultado = mysqli_query($con,$comando);
          $data = array();
          if(!$resultado){
            echo "não foi possivel salvar avaliação no banco de dados" .mysqli_error($con);
          }

          while($res = mysqli_fetch_assoc($resultado)){
            array_push($data,array("nome" => $res['nome_avaliador'],
                                   "nota" => $res['nota'],
                                   "comentario" => $res['comentario']));
          }

          return $data;

        }





  }

?>
