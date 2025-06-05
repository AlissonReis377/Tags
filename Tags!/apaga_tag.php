<?php
session_start();
require_once('db.class.php'); //puxa a classe do banco de dados
require_once('Tag.class.php'); //puxa a classe tag

if (!isset($_POST['id_tag']) || !isset($_SESSION['id'])) {
    echo "Erro: dados incompletos.";
    exit;
}

$id_tag = intval($_POST['id_tag']);
$id_usuario = $_SESSION['id'];

$objDb = new Db();
$link = $objDb->conecta_mysql();

if (Tag::deletarPorId($id_tag, $id_usuario, $link)) { //puxa o metodo de apagar post
    echo "Tag apagada com sucesso!";
} else {
    echo "Erro ao apagar a tag.";
}
?>
