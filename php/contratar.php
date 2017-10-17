<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Link para arquivos CSS-->
 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link rel="stylesheet" href="icones/css/font-awesome.min.css">


  
</head>
<body>
  
  
  <section id="contratar.php">
    	<?php

    		if(isset($_POST)){
    			 
				      $quebra_linha = "\n";
				      $emailOrigem = "leandro@neruseventos.com";
				      $nomeOrigem = "Leandro Nerus";
				      $emailDestino = "leandro@neruseventos.com";
				      $assunto = "Contato Nerus";
				      $mensagem = "nome: ".$_POST["nome"] ."<br/>";
				      $mensagem .= "telefone: " .$_POST["telefone"] ."<br/>";
				      $mensagem .= "Detalhes da revenda:" .$_POST['revenda_descricao'];
				     

				      $headers = "MIME-Version: 1.1".$quebra_linha;
				      $headers .= "Content-type: text/html;charset = iso-8859-1".$quebra_linha;
				      $headers .= "From: " .$emailOrigem.$quebra_linha;
				      $headers .= "Return-Path: " .$emailOrigem .$quebra_linha;
				      $headers .= "Reply-To: " .$emailOrigem.$quebra_linha;

				      mail($emailDestino,$assunto,$mensagem,$headers,"-r".$emailOrigem);


    



    		}
    	?>
  </section>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>


</body>


</html