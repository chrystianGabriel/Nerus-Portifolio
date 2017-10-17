function setAvatar(source){
	let avatar = document.getElementById('img-avatar');
  document.getElementById('status-avatar').value = 'Original';
  avatar.src = source;
}
function setTipo(tipo){
  let tipoLocutor = document.getElementById('tipo-locucao');
  tipoLocutor.selectedIndex = tipo;
}
function setNome(nome){

	let nomeLocutor = document.getElementById('input-nome');
	nomeLocutor.value = nome;
}
function setDescricao(descricao){
  descricao = descricao.replace(/<br>/g,'\n');
  console.log(descricao);
  let descricaoLocutor = document.getElementById('textarea-descricao');
  descricaoLocutor.value = descricao;
}

function setCEP(cep){

  let cepLocutor = document.getElementById('input-cep');
  cepLocutor.value = cep;
}
function setImagem(source){
	
	let img = document.getElementsByClassName('img-preview');
	let nodePai = img[img.length - 1].parentNode;
	nodePai.children[nodePai.children.length-1].value = 'Original';
	img[img.length - 1].src = source;
	img[img.length - 1].style.opacity = 1;

}
function setVideo(source){
	let video = document.getElementsByClassName('input-videos');
	video[video.length-1].value = source;
}

function setAudio(source){
	let audio = document.getElementsByClassName('input-audios');
	audio[audio.length-1].value = source;
}

function setTags(tag){

  if(tag == "hipermercado"){

    document.getElementById('tipo_locucao1').checked = "true";
    
  }else if(tag == "mercado"){

    document.getElementById('tipo_locucao2').checked = "true";

  }else if(tag == "via varejo"){

    document.getElementById('tipo_locucao3').checked = "true";

  }else if(tag == "confecção"){

    document.getElementById('tipo_locucao4').checked = "true";

  }else if(tag == "açougue"){

    document.getElementById('tipo_locucao5').checked = "true";

  }else if(tag == "postos de combustíveis"){

    document.getElementById('tipo_locucao6').checked = "true";

  }
}

function previewAvatar(){

  if(FileReader !== undefined){
    var fileReader = new FileReader();
    var file = document.getElementById("input-img");
    fileReader.readAsDataURL(file.files[0]);
    fileReader.onload = function(event){
      document.getElementById("img-avatar").src = event.target.result;
      document.getElementById("img-avatar").style.opacity = 1;
      document.getElementById('status-avatar').value = 'Alterado'
    }
  }
}

function previewImagens(caminho_anterior,file_atual){

  var nodePai = document.getElementById("adiciona-imagem");
  var nodeFilho = document.getElementsByClassName("add-img");
  var nodeClone = nodeFilho[nodeFilho.length-1].cloneNode(true);


  if(FileReader !== undefined){

    var fileReader = new FileReader();

    var file = file_atual;

    fileReader.readAsDataURL(file.files[0]);
    fileReader.onload = function(event){
      file.parentNode.children[2].src = event.target.result;
      file.parentNode.children[2].style.opacity = 1;
    }

    if( nodeFilho.length > 1){
     if(nodeClone.children[0].value !== ""){
      nodePai.appendChild(nodeClone);
      nodeClone.children[2].src = "";
      nodeClone.children[2].style.opacity = 0;
      nodeClone.children[0].value = "";
      nodeClone.children[0].required = false;
    }else{
     let nodePai = file.parentNode;
     nodePai.children[nodePai.children.length-1].value = "Alterado"
   }

 }else{
  nodePai.appendChild(nodeClone);
  nodeClone.children[2].src = "";
  nodeClone.children[2].style.opacity = 0;
  nodeClone.children[0].value = "";
  nodeClone.children[0].required = false;
}




}



}

function deletarImagem(imagem){
  let img = document.getElementsByClassName("deletar-imagem");
  let codigo = decodeURI(window.location.href).indexOf('editar=');
  codigo = decodeURI(window.location.href).substr(codigo + 7,codigo+13);
  let tipo = decodeURI(window.location.href).indexOf('tipo=');
  tipo = decodeURI(window.location.href).substr(tipo + 5,tipo+6);

  let src = imagem.parentNode.children[2].src;

  if(img.length < 2){
    alert("Nenhuma Imagem Adicionada");
  }else{
    let deletar = confirm("Tem certeza que deseja deletar esta imagem?");

    if(deletar){
      let nodePai = imagem.parentNode;
      let nodeClone = nodePai.children[nodePai.children.length - 1].cloneNode(true);
      nodePai.parentNode.appendChild(nodeClone);

      if(imagem.parentNode.children[0].value == ""){


        $.get("../php/salvar-alteracoes.php","codigo=" + codigo + "&src=" + src + "&tipo=" + tipo,function(res){
          imagem.parentNode.children[2].src = "";
          imagem.parentNode.children[2].style.opacity = 0;
          imagem.parentNode.children[0].value = "";
          imagem.parentNode.remove();
        });

      }else{
        nodePai.children[nodePai.children.length - 1].value = "removida";
        imagem.parentNode.children[0].value = "";
        imagem.parentNode.remove();
      }


    }

  }
}







  function adicionarVideos(video){

    let nodePai = video.parentNode;
    let nodeAvo = nodePai.parentNode;
    let nodeClone = nodePai.cloneNode(true);
    nodeClone.children[0].value  = "";
    nodeClone.children[0].required  = false;
    nodeAvo.appendChild(nodeClone);
  }
  function deletarVideos(video){
    let videos = document.getElementsByClassName("add-videos");

    if(videos.length < 2){
      alert("Nenhum Video Adicionado");
    }else{
      video.parentNode.children[0].value = "";
      video.parentNode.remove();
    }
  }

  function adicionarAudios(audio){
    let nodePai = audio.parentNode;
    let nodeAvo = nodePai.parentNode;
    let  nodeClone = nodePai.cloneNode(true);
    if(nodePai.children[2].children[0].className == "glyphicon glyphicon-plus"){

      nodePai.children[2].children[0].className = "glyphicon glyphicon-refresh";
      nodeClone.children[0].value = "";
      nodeClone.children[1].value = "";
      nodeClone.children[1].required = false;
      nodeAvo.appendChild(nodeClone);
    }
    nodePai.children[0].value = nodePai.children[1].files[0].name;




  }
  function removerAudio(audio,caminho_audio){
   let audios = document.getElementsByClassName("add-audios");
   let codigo = decodeURI(window.location.href).indexOf('editar=');
   codigo = decodeURI(window.location.href).substr(codigo + 7,codigo+13);
   let tipo = decodeURI(window.location.href).indexOf('tipo=');
   tipo = decodeURI(window.location.href).substr(tipo + 5,tipo+6);

   if(audios.length < 2){
     alert("Nenhum Audio Adicionado!");
   }else{
     let deletar = confirm('Tem certeza que deletar este audio?');
     if(deletar){
      console.log(audio.parentNode.children[1].value);
      if(audio.parentNode.children[1].value == ""){
       $.get("../php/salvar-alteracoes.php","codigo=" + codigo + "&caminho_audio=" + caminho_audio + "&tipo=" + tipo,function(res){
        audio.parentNode.remove();
      });
     }else{
       audio.parentNode.remove();
     }

   }

 }
}
function mudarTipoLocutor(){
  let selector = document.getElementById("tipo-locucao");
  let videos = document.getElementById("videos");
  let imagens = document.getElementById("imagens");


  if(selector.selectedIndex == 0){

    videos.style.display = "block";
    imagens.style.display = "block";

  }else{
    videos.style.display = "none";
    imagens.style.display = "none";

  }


}
