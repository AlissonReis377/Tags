<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('location: index.php?erro=1');
    exit();
}

$foto = $registro['foto_perfil'] ?? 'default.jpg';

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
        u.id_usuario,
        u.foto_perfil
    FROM tag AS t
    JOIN usuarios AS u ON t.id_usuario = u.id_usuario
    ORDER BY t.data_inclusao DESC

";

$resultado_id = mysqli_query($link, $sql);

if ($resultado_id) {
    while ($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {

        echo '<div class="wow animate__animated animate__fadeIn" data-wow-duration="1.5s">';

        
        echo '<div class="list-group-item tags_post" id="tag_'.$registro['id_tag'].'">';

            $foto = $registro['foto_perfil'] ?? 'default.jpg';

            echo '<h4 class="list-group-item-heading usuario">';
                echo '<img src="uploads/perfil/'.$foto.'" class="rounded-circle me-3" width="50" height="50" />'.$registro['usuario'].' <small>#'.$registro['id_usuario'].'</small>';
            echo '</h4>';
            echo '<div class="tag_post_registo">';
            echo '<p class="list-group-item-text">'.htmlspecialchars($registro['tag']).'</p>';
            echo '</div>';
            echo '<hr />';
            echo'<div class="container">';
            echo'<div class="col-md-6">';
            echo '<small>'.$registro['data_formatada'].'</small>';
            echo '</div>';
            echo'<div class="col" style="margin-left: 200px">';
            if ($registro['id_usuario'] == $id_usuario_logado) {
                echo'<div class="dropdown">
                        <button class="btn dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
  <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
</svg>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item btn-deletar-tag" data-id="'.$registro['id_tag'].'">Apagar</a></li>
                        </ul>
                        </div>';
            }
            echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '<br>';
    }
} else {
    echo "Houve um erro na consulta de Tags no banco de dados";
}
?>
