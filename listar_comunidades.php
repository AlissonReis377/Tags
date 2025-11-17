<?php

    session_start();
//validação sessao suussususuusa  usuaraio to com sono
    if(!isset($_SESSION['usuario'])){
        header('location: index.php?erro=1');
    }

	//puxa tudo logo nessa budega
	require_once('db.class.php');
	require_once('Usuario.class.php');
	require_once('consulta.class.php');
    require_once('comunidades.php');
	
	$objDb = new Db();
	$link = $objDb->conecta_mysql();

?>

<script>
    $(document).ready(function(){
        $('#btn_criar_comunidade').click(function(){
            $.ajax({
                url: 'criar_comunidade.php',
                method: 'post',
                data: $('#form_criar_comunidade').serialize(),
                success: function(data){
                    alert('Comunidade criada com sucesso!');
                }
            });
        });
    });
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunidades</title>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

    <!-- bootstrap - link cdn -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!--animte.css-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body>
    
		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top " style="font-family: monospace;">
	      <div class="container">
	        <div class="navbar-header">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="home.php">Home</a></li>
                </ul>
            </div>
	          <ul class="nav navbar-nav navbar-right">
				  <li><a href="perfil_usuario.php">Perfil</a></li>
				  <li><a href="buscar.php">Buscar</a></li>
				  <li><a href="#">Configurações</a>
				  <li><a href="sair.php">Sair</a></li>
				</li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


<div class="container">
    <h3>Comunidades</h3>
    <hr>
    <div class="row">
        <div class="col-lg-6">
            
            <h1 style='font-family: monospace;'>O que são as comunidades?</h1>

            <div class="bg-dark-subtle">
                <p></p>
            </div>
            
        </div>


        <div class="col-lg-6">
            <form class="" method="POST" action="criar_comunidade">
                <h3>Criar comunidade</h3>
                <input class="form-control " type="text" name="nome" placeholder="Nome da comunidade" required>
                <br>
                <textarea class="form-control" name="descricao" placeholder="Descrição da comunidade" required></textarea>
                <br>
                <input class="btn btn-sucess" type="submit" value="criar Comunidade">
            </form>
        </div>
    </div>
</div>







<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
</body>
</html>