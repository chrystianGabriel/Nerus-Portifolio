<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Link para arquivos CSS-->
  <!-- <link rel="stylesheet" href="../css/estilos-globais.css"> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link rel="stylesheet" href="icones/css/font-awesome.min.css">

  <!-- Importe de todos os iscripts javascript -->
  
</head>
<body>

  <?php
  try {


          $conteudoArquivo = ""; //esta variavel ira guardar as informações do locutor para que o arquivo seja enviado para o administrador do sistema


          
          
          /**
           * salvando  dados pessoais do locutor
           */


          $conteudoArquivo .= "Dados Pessoais: \r\n\r\n";
          $conteudoArquivo .= "nome: " .$_POST["nome"] ."\r\n\r\n";
          $conteudoArquivo .= "rg: " .$_POST['rg'] ."\r\n\r\n";
          $conteudoArquivo .= "cpf: " .$_POST['cpf'] ."\r\n\r\n";
          $conteudoArquivo .= "cep: " .$_POST['cep'] ."\r\n\r\n";
          $conteudoArquivo .= "logradouro: " .$_POST['logradouro'] ."\r\n\r\n";
          $conteudoArquivo .= "cidade: " .$_POST['cidade'] ."\r\n\r\n";
          $conteudoArquivo .= "stado: " .$_POST['estado'] ."\r\n\r\n";
          $conteudoArquivo .= "numero: " .$_POST['numero'] ."\r\n\r\n";
          $conteudoArquivo .= "complemento: " .$_POST['complemento'] ."\r\n\r\n";


          /**
           * Salvando dados de contato
           */
          $conteudoArquivo .= "Dados de Contato: \r\n\r\n";
          $conteudoArquivo .= "telefone: " .$_POST["telefone"] ."\r\n\r\n";
          $conteudoArquivo .= "email: " .$_POST["email"] ."\r\n\r\n";
          $conteudoArquivo .= "celular: " .$_POST["celular"] ."\r\n\r\n";
          $conteudoArquivo .= "wpp: " .$_POST["wpp"] ."\r\n\r\n";
          

           /**
            * salvando dados bancarios
            */
           $conteudoArquivo .="Dados Bancarios: \r\n\r\n";
           $conteudoArquivo .="banco: " .$_POST["banco"] ."\r\n\r\n";
           $conteudoArquivo .="conta: " .$_POST["conta"] ."\r\n\r\n";
           $conteudoArquivo .="agencia: " .$_POST["agencia"] ."\r\n\r\n";
           $conteudoArquivo .="tipo conta: " .$_POST["tipo_conta"] ."\r\n\r\n";
           
           /**
            * Revendas
            */
           $conteudoArquivo .="Dados de Revendas: \r\n\r\n";
           $conteudoArquivo .="Hipermercado: " .$_POST["hiper"] ."\r\n\r\n";
           $conteudoArquivo .="mercado: " .$_POST["mercado"] ."\r\n\r\n";
           $conteudoArquivo .="via varejo: " .$_POST["via_varejo"] ."\r\n\r\n";
           $conteudoArquivo .="confecçao: " .$_POST["confeccao"] ."\r\n\r\n";
           $conteudoArquivo .="açougue: " .$_POST["acougue"] ."\r\n\r\n";
           $conteudoArquivo .="posto de combutivel: " .$_POST["posto_de_combustivel"] ."\r\n\r\n";
           $conteudoArquivo .="Disponivel para viagem?  " .$_POST["viagens"] ."\r\n\r\n";






           /**
            * Salvar dados no arquivo
            */
           $arquivo = fopen("dados.txt","w");
           fwrite($arquivo,$conteudoArquivo);
           fclose($arquivo);

           $arquivo = fopen("dados.txt","rb");
           $anexo = fread($arquivo,filesize("dados.txt"));
           $anexo = base64_encode($anexo);

           fclose($arquivo);

           $anexo = chunk_split($anexo);



            // preparando para enviar email

           $boundary =  "XYZ-" . date("dmYis") . "-ZYX"; 
           $quebra_linha = "\n";
           $mens = "--$boundary" . $quebra_linha . ""; 
           $mens .= "Content-Transfer-Encoding: 8bits" . $quebra_linha . ""; 
           $mens .= "Content-Type: text/html; charset=\"ISO-8859-1\"" . $quebra_linha . "" . $quebra_linha . ""; //plain 
           
           $mens .= "--$boundary" . $quebra_linha . ""; 
           $mens .= "Content-Type: "."text/plain"."" . $quebra_linha . ""; 
           $mens .= "Content-Disposition: attachment; filename=\"".'dados.txt'."\"" . $quebra_linha . ""; 
           $mens .= "Content-Transfer-Encoding: base64" . $quebra_linha . "" . $quebra_linha . ""; 
           $mens .= "$anexo" . $quebra_linha . ""; 
           $mens .= "--$boundary--" . $quebra_linha . ""; 

            $headers = "MIME-Version: 1.0" . $quebra_linha . ""; 
            $headers .= "From: leandro@neruseventos.com" . $quebra_linha . ""; 
            $headers .= "Return-Path: leandro@neruseventos.com " . $quebra_linha . ""; 
            $headers .= "Content-type: multipart/mixed; boundary=\"$boundary\"" . $quebra_linha . ""; 
            $headers .= "$boundary" . $quebra_linha . ""; 



$teste = mail("chrystiangabriel1@hotmail.com", "Dados: " .$_POST['nome'], $mens, $headers,"-r"."leandro@neruseventos.com");

















} catch (Exception $e) {

}

?>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>


</body>


</html