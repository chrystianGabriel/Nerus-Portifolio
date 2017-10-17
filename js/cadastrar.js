
function previewAvatar(){

  if(FileReader !== undefined){
    var fileReader = new FileReader();
    var file = document.getElementById("input-img");
    fileReader.readAsDataURL(file.files[0]);
    fileReader.onload = function(event){
        document.getElementById("img-avatar").src = event.target.result;
        document.getElementById("img-avatar").style.opacity = 1;
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
        if(localStorage.i == undefined){
          localStorage.i = 0;
        }
        fileReader.readAsDataURL(file.files[0]);
        fileReader.onload = function(event){
          file.parentNode.children[2].src = event.target.result;
          
          file.parentNode.children[2].style.opacity = 1;
         }

         if( nodeFilho.length > 1){
             if(nodeClone.children[0].value !== ""){
                nodeClone.children[0].className += "banana" 
                localStorage.i++;
                nodePai.appendChild(nodeClone);
                nodeClone.children[2].src = "";
                nodeClone.children[2].style.opacity = 0;
                nodeClone.children[0].value = "";
                nodeClone.children[0].required = false;
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
    if(img.length < 2){
      alert("Nenhuma Imagem Adicionada");
    }else{
      imagem.parentNode.children[0].value = "";
      imagem.parentNode.remove();

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
function removerAudio(audio){
   let audios = document.getElementsByClassName("add-audios");

   if(audios.length < 2){
     alert("Nenhum Audio Adicionado!");
   }else{
     audio.parentNode.remove();
   }
}
function mudarTipoLocutor(){
    let selector = document.getElementById("tipo-locucao");
    let videos = document.getElementById("videos");
    let imagens = document.getElementById("imagens");

    if(selector.selectedIndex == 0){
         videos.style.display = "block";
        imagens.style.display = "block";
        videos.children[1].children[0].children[0].required = true;
        imagens.children[1].children[0].children[0].required = true;
    }else if(selector.selectedIndex == 1){
      videos.style.display = "none";
      videos.children[1].children[0].children[0].required = false;
      imagens.style.display = "none";
      imagens.children[1].children[0].children[0].required = false;
    }
    

}

