<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Link para arquivos CSS-->
  <link rel="stylesheet" href="../css/estilos-globais.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link rel="stylesheet" href="icones/css/font-awesome.min.css">
  
  
</head>
<body>
  <!-- menu Responsivo -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark  navbar-fixed-top">
    <a class="navbar-brand" href="../home.html"><img src="../img/nerus logo.png" width="200px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="../home.html">Home<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="casting.php">Casting</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../formulario_trabalhe_conosco.html">Trabalhe Conosco </a>
          <li class="nav-item">
            <a class="nav-link" href="contato.php">Contato</a>
          </li>
        </li>
      </ul>
    </div>
  </nav>
   
  <section id="servicos">
    <div class="container content">
      <div class="row">
        <div class="col-sm-12 col-xs-12">

          <div class="row">
            <div class="col-sm-12 col-xs-12">
              <header class="titulo">Fale Conosco</header>
            </div>
          </div>
          <form action="contato.php" method="POST">
            <div class="row">
              <div class="col-sm-12 col-xs-12">
                <div class="form-group centralizar">
                 <label for="inputNome">Nome</label>
                 <input type="text" class="form-control" id="inputNome" name="nome" >
                
                 <label for="inputEmail">Email</label>
                 <input type="text" class="form-control" id="inputEmail" name="email"    required >
 
                 <label for="inputNumero">Numero</label>
                 <input type="text" class="form-control" id="inputNumero" name="telefone"   required>

                 <label for="textareaMensagem">Mensagem</label>
                <textarea  cols="60" rows="10" placeholder="digite sua mensagem aqui!" id="textareaMensagem" class="form-control" name="mensagem" required></textarea>
              
                <input type="submit" class="btn btn-lg btn-success enviar">
               </div>
             </div>
            
           </div>
         </form>
       </div>
     </div>
   </div>
 </section>
  <!-- pega os dados do formulario para enviar o email -->
  <?php
      if(isset($_POST['nome'])){
        $quebra_linha = "\n";
        $emailOrigem = "leandro@neruseventos.com";
        $nomeOrigem = "Leandro Nerus";
        $emailDestino = "leandro@neruseventos.com";
        $assunto = "Contato Nerus";
        $mensagem = "nome: ".$_POST["nome"] ."<br/>";
        $mensagem .= "email: ".$_POST["email"] ."<br/>";
        $mensagem .= "telefone: ".$_POST["telefone"] ."<br/>";
        $mensagem .= "mensagem: <br>" .str_replace("\n","<br>",$_POST['mensagem']) ."<br>";

        $headers = "MIME-Version: 1.1".$quebra_linha;
        $headers .= "Content-type: text/html;charset = iso-8859-1".$quebra_linha;
        $headers .= "From: " .$emailOrigem.$quebra_linha;
        $headers .= "Return-Path: " .$emailOrigem .$quebra_linha;
        $headers .= "Reply-To: " .$emailOrigem.$quebra_linha;

        mail($emailDestino,$assunto,$mensagem,$headers,"-r".$emailOrigem);
      }


    



  ?>

 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>


</body>


</html