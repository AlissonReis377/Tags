<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header('location: index.php?erro=1');
}

require_once('db.class.php');
require_once('Tag.class.php');

$texto_tag = $_POST['texto_tag'];
$id_usuario = $_SESSION['id'];

if($texto_tag == '' || $id_usuario == ''){
    die();
}

$objDb = new Db();
$link = $objDb->conecta_mysql();

$tag = new Tag($id_usuario, $texto_tag, $link); //
$tag->salvar();
?>
