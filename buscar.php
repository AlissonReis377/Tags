<?php

//começa aqui mas pega o coisa do php ali em cima
session_start();
//validação sessao do usuario
    if(!isset($_SESSION['usuario'])){
        header('location: index.php?erro=1');
    }

	//puxa tudo que tem no banco de dados
	require_once('db.class.php');
	require_once('Usuario.class.php');
	require_once('consulta.class.php');
	$objDb = new Db();
	$link = $objDb->conecta_mysql();

    //acaba aqui
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar</title>
</head>
    <body>
        <!-- jquery - link cdn -->
            <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

            <!-- bootstrap - link cdn -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">




    </body>
</html> 
