<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('location: index.php?erro=1');
    exit();
}

require_once('db.class.php');

$id_usuario_logado = $_SESSION['id'];

$objDb = new Db();
$link = $objDb->conecta_mysql();

$sql = "
    SELECT 
        t.id_tag,
        DATE_FORMAT(t.data_inclusao, '%d %b %Y %T') AS data_formatada,
        t.tag,
        u.usuario,
        u.id_usuario 
    FROM tag AS t 
    JOIN usuarios AS u ON (t.id_usuario = u.id_usuario)
    ORDER BY t.data_inclusao DESC
";

$resultado_id = mysqli_query($link, $sql);

if ($resultado_id) {
    while ($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {
        echo '<div class="list-group-item" id="tag_'.$registro['id_tag'].'">';
            echo '<h4 class="list-group-item-heading">';
                echo $registro['usuario'].' <small>#'.$registro['id_usuario'].'</small>';
            echo '</h4>';
            
            echo '<p class="list-group-item-text">'.htmlspecialchars($registro['tag']).'</p>';
            if ($registro['id_usuario'] == $id_usuario_logado) {
                echo '<div class="" id="tag_123">';
                echo '<br><button class="btn btn-danger btn-xs btn-deletar-tag" data-id="'.$registro['id_tag'].'">Apagar</button>';
                echo '</div>';
            }
            echo '<hr />';
            echo '<small>'.$registro['data_formatada'].'</small>';


        echo '</div>';
        echo '<br>';
    }
} else {
    echo "Houve um erro na consulta de Tags no banco de dados";
}
?>
