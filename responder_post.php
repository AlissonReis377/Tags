<?php

require_once('db.class.php');
$objDb = new Db();
$link = $objDb->conecta_mysql();
$id_tag = intval($_GET['id']);
$sql = "SELECT 
            t.id_tag,
            t.tag,
            DATE_FORMAT(t.data_inclusao, '%d %b %Y') AS data_formatada,
            u.username,
            u.usuario,
            u.id_usuario,
            u.foto_perfil
        FROM tag t
        JOIN usuarios u ON u.id_usuario = t.id_usuario
        WHERE t.id_tag = $id_tag";

$result = mysqli_query($link, $sql);
$registro = mysqli_fetch_array($result, MYSQLI_ASSOC);
if (!$registro) {
    echo "Erro: Tag não encontrada.";
    exit;
}
$foto = $registro['foto_perfil'] ?? "default.jpg";





?>