

    /**
     * Verifica se o scrool esta em 0, se não estiver ele exibe todos
     * os elementos
     */
    function ChecarParallax(){
      if(window.pageYOffset != 0){
         var sections = document.getElementsByTagName("section");
        for (var i = sections.length - 1; i >= 0; i--) {
         sections[i].style.opacity = "1";

       }
     }
   }
   /*
      Faz com que os elementos apareção de acordo com o scroll for descendo
    */
  function parallaxSection(){
    var sections = document.getElementsByTagName("section");
    var body = document.getElementsByTagName("body");
    let porcentagem = 100/sections.length;
    let posicaoAtual = ((window.pageYOffset*100)/body[0].offsetWidth)/100;
    let pos = parseInt(posicaoAtual*(sections.length-1));

    
    if(pos < sections.length-1){
      sections[pos].style.opacity = "1";
      sections[pos].style.marginTop = "0px";
    }else{
       sections[pos].style.opacity = "1";
    }


  }

  window.addEventListener('scroll',parallaxSection);