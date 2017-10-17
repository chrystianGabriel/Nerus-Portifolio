function mudarTextoHistoria(label){
	let textos = document.getElementsByClassName("historia-conteudo");
	let a = document.getElementsByClassName("paleta-janela");
	let i = Number(label.id.match('[0-9]+')[0]);
	let j = textos.length-1;

	while(j > -1){
		textos[j].style.display= "none";
		j--;
	}
	textos[i - 1].style.display = "block";

}