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
    <title>Perfil</title>
    <!-- jquery - link cdn -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <!-- bootstrap - link cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <style></style>
</head>
<body>
<div id="visualizacao">
    <section>
        <div class="cabecalho-perfil">
            <div>
                <img id="foto_visu" alt="Foto_perfil" width="150" height="150">
            </div>
        </div>
    </section>
</div>
</body>
</html>