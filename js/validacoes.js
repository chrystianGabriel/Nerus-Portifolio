function validarCPF(){
	let CPF = document.getElementById("inputCPF");
	let aux = CPF.value.substring(0,3) + ".";
	aux += CPF.value.substring(3,6) + ".";
	aux += CPF.value.substring(6,9) + "-" + CPF.value.substring(9,11);
	
	// validar primeiro digito do cpf
	
	let cpfAux = parseInt(CPF.value.substring(0,9));
	let resto = cpfAux%10;
	let coeficiente = parseInt(cpfAux/10);
	let res = resto*2;
	let multiplicador = 3;

	while(coeficiente > 0){
		
		resto = coeficiente%10;

		coeficiente = parseInt(coeficiente/10);
		res += resto*multiplicador;

		multiplicador++;
	}
	
	res = (res*10)%11;
	(res < 2 || res > 9)? res = 0:res = res;
	
	
	if(res == CPF.value.substring(9,10)){

		cpfAux = parseInt(CPF.value.substring(0,10));
		resto = cpfAux%10;
		coeficiente = parseInt(cpfAux/10);
		res = resto*2;
		multiplicador = 3;
		


		while(coeficiente > 0){
			

			resto = coeficiente%10;
			coeficiente = parseInt(coeficiente/10);
			res += resto*multiplicador;
			multiplicador++;

		}


		res = (res*10)%11;
		(res < 2 || res > 9)? res = 0:res = res;

		if(res == CPF.value.substring(10,11)){
			CPF.value = aux;
		}else{
			CPF.value = "";
			alert("CPF invalido");
		}
		

		
	}else{
		CPF.value = "";
		alert("CPF invalido");
	}

	
	

}

function validarCEP(codigo){
	let CEP = document.getElementById("inputCEP");
	let reg = new RegExp();
	reg = /[a-z]/;

	if(reg.test(CEP.value)){
		CEP.value = "";
		alert("CEP INVALIDO!");
	}

	if(CEP.value.length == 8){
		$.ajax({
			url: 'http://cep.republicavirtual.com.br/web_cep.php?cep=' + CEP.value + "&formato=jsonp&callback=validarCEP",
			dataType: 'jsonp',
			crossDomain: true,
			contentType: "application/json",
			statusCode: {

				200: function(data){
					if(data.resultado > 0){
						console.log(data);
						CEP.value = CEP.value.substring(0,5) + "-" + CEP.value.substring(5,8);
						
						document.getElementById("inputLogradouro").value  = data.logradouro;
						document.getElementById("inputCidade").value  = data.cidade;
						document.getElementById("inputEstado").value  = data.uf;
					}else{
						CEP.value = "";
						alert("CEP INVALIDO!");
					}
					
				},
			}
		});

		
		
	}else{

		CEP.value = "";
		alert("CEP INVALIDO!");
	}
}

function validarTelefone(){
	let telefone = document.getElementById("inputTelefone");

	if(telefone.value.length  == 10){
		telefone.value = "(" + telefone.value.substring(0,2) + ")" + telefone.value.substring(2,6) + "-" + telefone.value.substring(6,10);
	}else{
		telefone.value = "";
		alert("Telefone Cadastrado invalido");
	}
}
function validarEmail(){
	let email = document.getElementById("inputEmail");
	if(!(email.value.indexOf("@") > -1 && 
		email.value.indexOf(".") > -1 && 
		email.value.indexOf(".") < email.value.length-1 &&
		email.value.indexOf("@") < email.value.length-1)){
		email.value = "";
	alert("Email Invalido!!");
}
}

function validarCelular(){
	let Celular = document.getElementById("inputCelular");

	if(Celular.value.length  == 10){
		Celular.value = "(" + Celular.value.substring(0,2) + ")" + Celular.value.substring(2,6) + "-" + Celular.value.substring(6,10);
	}else if(Celular.value.length  == 11){
		Celular.value = "(" + Celular.value.substring(0,2) + ")" + Celular.
		value.substring(2,7) + "-" + Celular.value.substring(7,11);	
	}else{
		Celular.value = "";
		alert("Celular digitado invalido");
	}
}


function validarPrecoRevenda(id){
	let precoRevenda = document.getElementById(id);
	let tamanho  =  precoRevenda.value.length;
	let aux = "";
	let j = 0;
	precoRevenda.value = precoRevenda.value.replace("R$ ","")

	let reg = new RegExp();
	reg = /[a-z]/;

	if(reg.test(precoRevenda.value)){

		precoRevenda.value = "";
		alert("Preço Invalido,por favor, insira somente numeros");
	}else{
		for (var i = precoRevenda.value.length-1; i > -1; i--) {
			
			
			if(j == 3){
				j = 0;
				aux = precoRevenda.value[i] + "," + aux;
			}else{
				aux = precoRevenda.value[i] + aux;
				
			}

			j++;

		}


		precoRevenda.value = "R$ " + aux;
	}
	

	
}