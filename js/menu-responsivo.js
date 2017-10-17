function mostrarMenu(){ 
	let menu = document.getElementsByClassName('menu');
	let itens = document.getElementsByClassName('menu-item');
	let linhas = document.getElementsByClassName('linha');
	if(menu[0].style.height == ""){
		// Desseparece com a linha do meio 
		linhas[1].style.display = "none";

		//faz com que as linhas ocupem o mesmo espaço na tela
		linhas[0].style.position = "absolute";
		linhas[2].style.position = "absolute";

		//preenche o meio das linhas
		linhas[0].style.background = linhas[0].style.borderColor;
		linhas[2].style.background = linhas[2].style.borderColor;

		//Gira as linhas no proprio eixo em 45 graus, formando um X
		linhas[0].style.transform = "rotate(45deg)";
		linhas[2].style.transform = "rotate(-45deg)";
		
		//calcula a altura nescessaria para aparecer todos os itens do menu
		menu[0].style.height = (50 * (itens.length-1)).toString() + "%" ;
		
	}else{
		

		//faz com que as linhas voltem a posição anterior
		linhas[0].style.position = "static";
		linhas[2].style.position = "static";

		//meio das linhas fica em branco
		linhas[0].style.background = "";
		linhas[2].style.background = "";

		//Volta pra prosição 0 para desmanchar o X
		linhas[0].style.transform = "rotate(0deg)";
		linhas[2].style.transform = "rotate(0deg)";


		// reaparece com a linha do meio 
		linhas[1].style.display = "block";

		//some com os itens do menu
		menu[0].style.height = "";
	}
	
}