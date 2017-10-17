function deletarLocutor(node){
	let codigo =node.parentNode.parentNode.children[0].innerHTML;
	codigo = codigo.replace(" ","");
	let deletar = confirm('Tem certeza que deseja deletar o locutor?');
	
	if(deletar){
		let url = '../php/listagem.php?deletar='+codigo;
		
		window.location.href = url;

	}

}
function editarLocutor(node){
	
	let codigo = node.parentNode.parentNode.children[0].innerHTML;
	let tipo = node.parentNode.parentNode.children[2].innerHTML;
	codigo = codigo.replace(" ","");
	tipo = tipo.replace(" ","");
	window.location.href = '../php/editar.php?editar='+codigo + '&tipo=' +  tipo;
	

	

}