<?php

    session_start();

    if(!isset($_SESSION['usuario'])){
    header('location: index.php?erro=1');
    }

require_once('db.class.php');

$id_usuario = $_SESSION['id'];
$seguir_id_usuario = $_POST['seguir_id_usuario'];
$seguindo = 1;

if($id_usuario == '' || $seguir_id_usuario == ''){
    die();
}


$objDb = new Db();
$link = $objDb->conecta_mysql();

$sql = "INSERT INTO usuarios_seguidores(id_usuario, seguindo_id_usuario, seguindo)VALUES($id_usuario, $seguir_id_usuario, $seguindo)";

mysqli_query($link, $sql);



?>