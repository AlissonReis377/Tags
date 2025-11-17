<?php
// Código convertido para Bootstrap 5 — versão completa reconstruída
// OBS: Somente HTML + Bootstrap foram alterados. PHP/JS mantidos.

session_start();
if(!isset($_SESSION['usuario'])){
    header('location: index.php?erro=1');
}

require_once('db.class.php');
require_once('Usuario.class.php');
require_once('consulta.class.php');

$objDb = new Db();
$link = $objDb->conecta_mysql();

$id_usuario = $_SESSION['id'];

$sql= "SELECT COUNT(*) AS qtd_tags FROM tag WHERE id_usuario = $id_usuario";
$resultado_id = mysqli_query($link, $sql);
$qtd_tags = ($resultado_id) ? mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)['qtd_tags'] : 0;

$sql= "SELECT COUNT(*) AS qtd_seguidores FROM usuarios_seguidores WHERE id_usuario = $id_usuario";
$resultado_id = mysqli_query($link, $sql);
$qtd_seguidores = ($resultado_id) ? mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)['qtd_seguidores'] : 0;

$sql= "SELECT COUNT(seguindo) AS qtd_seguindo FROM usuarios_seguidores WHERE id_usuario = $id_usuario";
$resultado_id = mysqli_query($link, $sql);
$qtd_seguindo = ($resultado_id) ? mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)['qtd_seguindo'] : 0;
?>

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Tags!</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="style/stylehome.css">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light" style="font-family: monospace;">
    <div class="container">
        <a class="navbar-brand icon-tags" href="home.php">Tags!</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="perfil_usuario.php">Perfil</a></li>
                <li class="nav-item"><a class="nav-link" href="buscar.php">Buscar</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Configurações</a></li>
                <li class="nav-item"><a class="nav-link" href="sair.php">Sair</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container" style="font-family: monospace;">
    <div class="row mt-4">

        <!-- Perfil -->
        <div class="col-md-3">
            <div class="card perfilhome">
                <div class="card-body text-center">
                    <img src="https://img.freepik.com/fotos-gratis/fotografia-em-close-up-de-um-lindo-gatinho-domestico-de-gengibre-sentado-em-uma-superficie-branca_181624-35913.jpg?semt=ais_hybrid&w=740&q=80" class="rounded-circle img-fluid mb-3"/>
                    <h4><?= $_SESSION['usuario'] ?> <small>#<?= $_SESSION['id'] ?></small></h4>
                    <h5 class="text-muted"><?= $_SESSION['bio'] ?></h5>
                    <hr>
                    <div class="row text-center">
                        <div class="col-6">
                            <strong>Seguindo</strong><br><?= $qtd_seguindo ?>
                        </div>
                        <div class="col-6">
                            <strong>Seguidores</strong><br><?= $qtd_seguidores ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-3 d-grid gap-2 opcoeshome">
                <a class="btn btn-outline-secondary btn-group-opcoes-home" href="home.php">Home</a>
                <a class="btn btn-outline-secondary btn-group-opcoes-home" href="perfil_usuario.php">Perfil</a>
                <a class="btn btn-outline-secondary btn-group-opcoes-home" href="buscar.php">Buscar Pessoas</a>
                <a class="btn btn-outline-danger btn-group-opcoes-home-sair" href="sair.php">Sair</a>
            </div>
        </div>

        <!-- Criar Tag -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <form id="form_tag" class="input-group">
                        <input type="text" id="texto_tag" name="texto_tag" class="form-control" placeholder="Comece suas Tags!" maxlength="200" />
                        <button class="btn btn-secondary" id="btn_tag" type="button">Fazer Tag</button>
                    </form>
                    <div id="mensagem_sucesso" class="text-success fw-bold mt-2" style="display: none;"></div>
                </div>
            </div>

            <div id="tags" class="list-group"></div>
        </div>

        <!-- Buscar Pessoas -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <form id="form_procurar_pessoas" class="input-group">
                        <input type="text" id="nome_pessoa" name="nome_pessoa" class="form-control" placeholder="Quem está procurando?" maxlength="200" />
                        <button class="btn btn-secondary" id="btn_procurar_pessoa" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
</svg></button>
                    </form>
                </div>
                <div id="pessoas" class="list-group"></div>
            </div>
        
				<div class="card card-novidades">
					<h4 class="" style="font-family: monospace;">Versão 1.0</h4>
						<div class="accordion" id="accordionExample">
							<div class="accordion-item">
								<h2 class="accordion-header">
								<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									Mudança de layout
								</button>
								</h2>
								<div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
								<div class="accordion-body">
									<strong>This is the first item’s accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It’s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
								</div>
								</div>
							</div>
							<div class="accordion-item">
								<h2 class="accordion-header">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									Comunidades
								</button>
								</h2>
								<div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
								<div class="accordion-body">
									<strong>This is the second item’s accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It’s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
								</div>
								</div>
							</div>
							<div class="accordion-item">
								<h2 class="accordion-header">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
									Foto de perfil
								</button>
								</h2>
								<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
								<div class="accordion-body">
									<strong>This is the third item’s accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It’s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
								</div>
								</div>
							</div>
						</div>
				</div>
		</div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script> new WOW().init(); </script>

<script>
$(document).ready(function(){

    $(document).on('click', '.btn-deletar-tag', function(){
        var id_tag = $(this).data('id');
        if(confirm("Deseja mesmo apagar esta tag?")){
            $.post('apaga_tag.php', { id_tag: id_tag }, function(data){
                alert(data);
                $('#tag_'+id_tag).fadeOut();
            });
        }
    });

    $('#btn_tag').click(function(){
        if($('#texto_tag').val().length > 0){
            $.post('inclui_tag.php', $('#form_tag').serialize(), function(){
                $('#texto_tag').val('');
                $('#mensagem_sucesso').text('Tag criada com sucesso!').show();
                setTimeout(()=> $('#mensagem_sucesso').fadeOut(), 3000);
                atualizaTag();
            });
        }
    });

    function atualizaTag(){
        $.get('get_tag.php', function(data){ $('#tags').html(data); });
    }
    atualizaTag();

    $('#btn_procurar_pessoa').click(function(){
        if($('#nome_pessoa').val().length > 0){
            $.post('get_pessoas.php', $('#form_procurar_pessoas').serialize(), function(data){
                $('#pessoas').html(data);

                $('.btn_seguir').click(function(){
                    var id = $(this).data('id_usuario');
                    $('#btn_seguir_'+id).hide();
                    $('#btn_deixar_seguir_'+id).show();
                    $.post('seguir.php', { seguir_id_usuario: id });
                });

                $('.btn_deixar_seguir').click(function(){
                    var id = $(this).data('id_usuario');
                    $('#btn_seguir_'+id).show();
                    $('#btn_deixar_seguir_'+id).hide();
                    $.post('deixar_seguir.php', { deixar_seguir_id_usuario: id });
                });
            });
        }
    });
});
</script>

</body>
</html>