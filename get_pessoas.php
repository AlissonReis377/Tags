<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    header('location: index.php?erro=1');
    exit();
}

require_once('db.class.php');
require_once('Usuario.class.php');
require_once('consulta.class.php');

$nome_pessoa = $_POST['nome_pessoa'];
$id_usuario = $_SESSION['id'];

$objDb = new Db();
$link = $objDb->conecta_mysql();

$usuarioDAO = new UsuarioDAO($link);
$resultado_id = $usuarioDAO->buscarPessoas($nome_pessoa, $id_usuario);


if($resultado_id) {
    while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {
        echo '<a href="#" class="list-group-item">';
            echo '<strong>'.$registro['usuario'].'</strong><small> - #'.$registro['id_usuario'].'</small><br>';

            $seguindo = isset($registro['id_usuario_seguidor']) ? true : false;
            $btn_seguir_display = $seguindo ? 'none' : 'block';
            $btn_dropar_display = $seguindo ? 'block' : 'none';

            echo '<button type="button" id="btn_seguir_'.$registro['id_usuario'].'" style="display: '.$btn_seguir_display.'" class="btn btn-default btn_seguir" data-id_usuario="'.$registro['id_usuario'].'">Seguir</button>';
            echo '<button type="button" id="btn_deixar_seguir_'.$registro['id_usuario'].'" style="display: '.$btn_dropar_display.'" class="btn btn-primary btn_deixar_seguir" data-id_usuario="'.$registro['id_usuario'].'">Dropar</button>';
            echo '<div class="clearfix"></div>';
        echo '</a>';
    }
} else {
    echo "Erro ao buscar pessoas.";
}
?>
