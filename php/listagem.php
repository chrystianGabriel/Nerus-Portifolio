<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Nerus Admin</title>

  <!-- Bootstrap -->
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!--CSS-->
  <link href="../css/menu.css" rel="stylesheet">
  <link href="../css/listagem.css" rel="stylesheet" />
  <script type="text/javascript" src="../js/listagem.js"></script>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>
    <body>
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
          <a class="navbar-brand" id="titulo"><strong>N e r u s &nbsp &nbsp L o c u ç õ e s</strong></a>

          </div>
        </div>
        <div>
          <ul class="nav navbar-nav navbar-right hidden-xs">
            <li class="item-menu">
              <label class="texto-menu"><a href="../dashboard.html">Inicio</a></label>
            </li>
            <li class="item-menu">
              <label class="texto-menu"><a href="listagem.php">Locutores</a></label>
            </li>


            <li class="item-menu">
              <a class="texto-menu" id="botao-sair" href="../index.html">Sair</a>
            </li>
          </ul>
        </div>

      </nav>

      <section id="listar-locututores">
        <div class="container">
          <table class="table">
            <thead id="table-header">
              <tr>
                <th>
                  Codigo
                </th>
                <th width="40%">
                  Nome
                </th>
                <th>
                  Tipo
                </th>
                <th>
                  Opções
                </th>
              </tr>
            </thead>

            <tbody>

              <?php
              include("dao-locutor.class.php");
              $locutores  = new daoLocutores();
              $resultado = $locutores->getLocutores();
              if(isset($_GET['deletar'])){
                $codigo = $_GET['deletar'];
                $locutores->removeLocutor($codigo);
                            //redireciona a pagina, para que ela seja atualizada;
                echo "<script>window.location.href = 'listagem.php';
              </script>";




            }

            for($i = 0; $i < sizeof($resultado);$i++){
              $res = $resultado[$i];
              echo "<tr>

              <th>
                $res[codigo]
              </th>";
              echo "<th>
              <a href='avaliacao.php?codigo=$res[codigo]'>$res[nome]</a>
            </th>";
            echo "<th>
            $res[tipo]
          </th>";

          echo "<th>
          <button type='button' class='btn btn-md btn-success'>Visualizar</button>
          <button type='button' class='btn btn-md btn-warning' onclick='editarLocutor(this)'>Editar</button>
          <button type='button' class='btn btn-md btn-danger' onclick='deletarLocutor(this)'>Excluir</button>
        </th>
      </tr>";
    }





    ?>
  </tbody>

</table>
</div>
</section>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
