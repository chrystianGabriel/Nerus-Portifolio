 <style>
 	#sucesso{
 		height: 150px;
 		font-size: 20px;
 		font-weight: 900;
 		text-align: center;

 	}
 	#erro{
 		height: 150px;
 		background: #8A0808;
 		color: black;
 		font-size: 20px;
 		font-weight: 900;
 		text-align: center;
 	}
 	label{

 		font-size: 60px;
 		font-weight: 900;

 	}

 </style>
 <?php


 include("dao-locutor.class.php");
 Include("upload-arquivos.class.php");


 if(isset($_GET['src'])){
 	$codigo = $_GET['codigo'];
 	$src= $_GET['src'];
 	$tipo = $_GET['tipo'];


 	$dao = new daoLocutores();
 	$src = "../" .substr($src,strpos($src,"upload"));

 	$dao->removerImagens($codigo,$src);



 }else if(isset($_GET['caminho_audio'])){
 	$codigo = $_GET['codigo'];
 	$caminho_audio= $_GET['caminho_audio'];
 	$tipo = $_GET['tipo'];


 	$dao = new daoLocutores();
 	$dao->removerAudios($codigo,$caminho_audio);



 }else{

 	$dao = new daoLocutores();
 	$novo_locutor = new locutores();
 	$codigo_locutor = $_POST['codigo'];
 	$locutor_antigo = $dao->getLocutor($codigo_locutor);
 	$locutor_antigo_imagens = $dao->getLocutorImagens($codigo_locutor);
 	$locutor_antigo_audios = $dao->getLocutorAudios($codigo_locutor);

 	$novo_locutor->setNome($_POST['input_nome']);
 	$novo_locutor->setTipo($_POST['tipo_locucao']);
 	$novo_locutor->setDescricao($_POST['textarea_descricao']);

 	$dao->updateLocutor($novo_locutor,$codigo_locutor);

	//*******************************//
	//********Remover Tags***********//
	//*******************************//

 	$dao->removerLocutorTags($codigo_locutor);
 	for ($i=0; $i <sizeof($_POST['tags_locutor']) ; $i++) { 

 		$dao->salvarTags($codigo_locutor,$_POST['tags_locutor'][$i]);


 	}








 	/*========================================================*/
 	/*Caso o avatar tenha sido alterado o novo avatar é salvo*/
 	/*=======================================================*/
 	if(isset($_POST['avatar'])){

 		if($_POST['avatar'] == 'Alterado'){
 			UploadArquivos::deletarAvatar($locutor_antigo['avatar']);
 			$caminho_avatar = UploadArquivos::uploadAvatar($_FILES["avatar"]["tmp_name"] ."*".$_FILES["avatar"]["name"]);

 			$dao->updateAvatar($codigo_locutor,$caminho_avatar);
 		}
 	}



 	/*************************************************/
 	/*As Operações abaixo dizem a respeito as imagens*/
 	/*************************************************/

 	if(isset($_POST['imagens'])){
 		/******************************************************************************/
 		/*Remove elementos vazio dos vetores, para garantir que eles possam ser salvos*/
 		/******************************************************************************/

 		$novas_imagens_temp = $_FILES["imagens"]["tmp_name"];

 		$novas_imagens_nome = $_FILES["imagens"]["name"];


 		for($i = 0;$i < sizeof($novas_imagens_temp);$i++){
 			$i = array_search("",$novas_imagens_temp);
 			$k = array_search("",$novas_imagens_nome);

 			unset($novas_imagens_temp[$i]);
 			unset($novas_imagens_nome[$k]);
 		}




     //salva o caminho temporario de cada imagem
 		for($i = 0; $i < sizeof($novas_imagens_temp);$i++){
 			$nome_temp = current($novas_imagens_temp);
 			$extensao = current($novas_imagens_nome);


 			if($extensao !== ""){

 				$novo_locutor->setImagens($nome_temp ."*".$extensao);



 			}

 			next($novas_imagens_nome);
 			next($novas_imagens_temp);


 		}





 		$imagens = $_POST['imagens'];

		//remove todos os espaços vazios no vetor
 		for($i = 0;$i < sizeof($imagens);$i++){
 			$index = array_search("",$imagens);

 			unset($imagens[$index]);

 		}

 		/*==========================================================*/
 		/*Caso as Imagens tenham sido alteradas elas seram trocadas*/
 		/*=========================================================*/


 		for($i = 0; $i < sizeof($imagens);$i++){
 			$imagem = current($imagens);
 			if($imagem == "Alterado"){

 				UploadArquivos::DeletarImagem($locutor_antigo_imagens[$i]['caminho_imagens']);
 				$dao->removerImagens($codigo_locutor,$locutor_antigo_imagens[$i]['caminho_imagens']);

 			}
 			next($imagens);
 		}

 		/*========================================*/
 		/*Faz upload e salva no BD as novas imagens*/
 		/*========================================*/

 		for($i = 0; $i < sizeof($novo_locutor->getImagensArray());$i++){
 			$novo_caminho = UploadArquivos::uploadImagens($novo_locutor->getImagens($i));

 			$dao->salvarImagens($novo_caminho,$codigo_locutor);
 		}

 	}


 	/*************************************************/
 	/*As Operações abaixo dizem a respeito as Audios*/
 	/*************************************************/

 	if(isset($_POST['audios'])){
 		/******************************************************************************/
 		/*Remove elementos vazio dos vetores, para garantir que eles possam ser salvos*/
 		/******************************************************************************/
 		$novos_audios_tmp = $_FILES["audios"]["tmp_name"];
 		$novos_audios_nome = $_FILES["audios"]["name"];

 		for($i = 0;$i < sizeof($novos_audios_tmp);$i++){
 			$i = array_search("",$novos_audios_tmp);
 			$k = array_search("",$novos_audios_nome);

 			unset($novos_audios_tmp[$i]);
 			unset($novos_audios_nome[$k]);
 		}



	//Salva o caminho temporario de cada audio
 		for($i = 0; $i < sizeof($novos_audios_tmp);$i++){
 			$nome_temp = current($novos_audios_tmp);
 			$extensao = current($novos_audios_nome);


 			if($extensao !== ""){

 				$novo_locutor->setAudios($nome_temp ."*".$extensao);



 			}

 			next($novos_audios_nome);
 			next($novos_audios_tmp);

 		}



 		$audios = $_POST['audios'];

		//remove todos os espaços vazios no vetor
 		for($i = 0;$i < sizeof($audios);$i++){
 			$index = array_search("",$audios);

 			unset($audios[$index]);

 		}

 		/*==========================================================*/
 		/*Caso os audios tenham sido alteradas elas seram deletadas*/
 		/*=========================================================*/


 		for($i = 0; $i < sizeof($audios);$i++){
 			$audio = current($audios);
 			if($audio == "Alterado"){

 				UploadArquivos::DeletarAudio($locutor_antigo_Audios[$i]['caminho_Audios']);
 				$dao->removerAudios($codigo_locutor,$locutor_antigo_Audios[$i]['caminho_Audios']);

 			}
 			next($audios);
 		}

 		/*========================================*/
 		/*Faz upload e salva no BD as novas imagens*/
 		/*========================================*/

 		for($i = 0; $i < sizeof($novo_locutor->getAudiosArray());$i++){
 			$nome_audio = substr($novo_locutor->getAudios($i),(strlen($novo_locutor->getAudios($i)) - strpos($novo_locutor->getAudios($i),"*"))*-1);

 			$nome_audio = str_replace("*","",$nome_audio);

 			$novo_caminho = UploadArquivos::uploadAudios($novo_locutor->getAudios($i));

 			$dao->salvarAudios($nome_audio,$novo_caminho,$codigo_locutor);
 		}





 	}

 	if($_POST['videos']){

 		$videos = $_POST['videos'];

		//remove todos os espaços vazios no vetor
 		for($i = 0;$i < sizeof($videos);$i++){
 			$index = array_search("",$videos);

 			unset($videos[$index]);

 		}


		 //salva o caminho de cada video
 		for($i = 0; $i < sizeof($videos);$i++){
 			$nome = current($videos);
 			$dao->removerVideo($codigo_locutor,$nome);
 			$novo_locutor->setVideos($nome);
 			next($videos);
 		}

 		for($i = 0; $i < sizeof($videos);$i++){

 			$dao->salvarVideos($novo_locutor->getVideos($i),$codigo_locutor);

 		}




 	}

 	echo "<header id='sucesso'>
 	<label>ツ</label>
 	<h2>Os dados foram alterados com sucesso com sucesso!</h2>
 	<h5>Você será redirecionado em alguns segundos!</h5>
 </header>";

 echo "<script>setTimeout(function(){location.href='listagem.php'},10000);</script>";


}










?>