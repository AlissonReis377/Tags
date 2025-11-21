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


//TOTAL DE TAGS
$sql= "SELECT COUNT(*) AS qtd_tags FROM tag WHERE id_usuario = $id_usuario";
$resultado_id = mysqli_query($link, $sql);

if (!$resultado_id) {
    die("ERRO SQL (tags): " . mysqli_error($link));
}

$linha = mysqli_fetch_assoc($resultado_id);
$qtd_tags = $linha ? $linha['qtd_tags'] : 0;




//Total de seguindo
$sql= "SELECT COUNT(*) AS qtd_seguindo 
       FROM usuarios_seguidores 
       WHERE id_usuario = $id_usuario
       AND seguindo = 1";

$resultado_id = mysqli_query($link, $sql);

if (!$resultado_id) {
    die("ERRO SQL (seguindo): " . mysqli_error($link));
}

$linha = mysqli_fetch_assoc($resultado_id);
$qtd_seguindo = $linha ? $linha['qtd_seguindo'] : 0;




//Total de seguidores
$sql= "SELECT COUNT(*) AS qtd_seguidores
       FROM usuarios_seguidores 
       WHERE id_usuario_seguidor = $id_usuario
       AND seguindo = 1";

$resultado_id = mysqli_query($link, $sql);

if (!$resultado_id) {
    die("ERRO SQL (seguidores): " . mysqli_error($link));
}

$linha = mysqli_fetch_assoc($resultado_id);
$qtd_seguidores = $linha ? $linha['qtd_seguidores'] : 0;


$sql = "SELECT foto_perfil FROM usuarios WHERE id_usuario = $id_usuario";
$resultado_id = mysqli_query($link, $sql);

if (!$resultado_id) {
    die("ERRO SQL (foto): " . mysqli_error($link));
}

$linha = mysqli_fetch_assoc($resultado_id);
$fotoPerfil = $linha ? $linha['foto_perfil'] : null;
?>


<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tags!</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="style/stylehome.css">
    
    <link rel="icon" href="imagens/tags.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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
                <!--Implementação futura<li class="nav-item"><a class="nav-link" href="perfil_usuario.php">Perfil</a></li>
                <li class="nav-item"><a class="nav-link" href="buscar.php">Buscar</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Configurações</a></li>-->
                <li class="nav-item"><a class="nav-link" href="sair.php">Sair</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container" style="font-family: monospace;">
    <div class="row mt-4">

        <!-- Perfil -->
        <div class="col-md-3 perfil-container">
            <div class="card perfilhome">
                <div class="card-body text-center">
                    <img src="uploads/perfil/<?= $fotoPerfil ?: 'default.jpg' ?>" class="rounded-circle img-fluid mb-3"/>
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
                    <a class="btn btn-outline-secondary btn-group-opcoes-home-mobile" href="#" data-bs-toggle="modal" data-bs-target="#editarPerfilModal">Editar perfil</a>
                </div>
            </div>

            <div class="mt-3 d-grid gap-2 opcoeshome">
                <a class="btn btn-outline-secondary btn-group-opcoes-home" href="home.php">Home</a>
                <!--IMPLEMENTAÇÃO FUTURA<a class="btn btn-outline-secondary btn-group-opcoes-home" href="perfil_usuario.php">Perfil</a>
                <a class="btn btn-outline-secondary btn-group-opcoes-home" href="buscar.php">Buscar Pessoas</a>-->
                <a class="btn btn-outline-secondary btn-group-opcoes-home" href="#" data-bs-toggle="modal" data-bs-target="#editarPerfilModal">Editar perfil</a>
                <a class="btn btn-outline-danger btn-group-opcoes-home-sair" href="sair.php">Sair</a>
            </div>
        </div>


        <!--modal para editar perfil-->
        <div class="modal fade" id="editarPerfilModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Perfil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center mb-3">
                        <img src="uploads/perfil/<?= $fotoPerfil ?: 'default.jpg' ?>" class="rounded-circle object-fit-cover" width="180">
                    </div>
                    
                    <div class="modal-body">
                        <form method="POST" action="editar_perfil.php" enctype="multipart/form-data">
                            
                            <div class="mb-3">
                                <label>Nome:</label>
                                <input type="text" name="nome" class="form-control" required="requiored" maxlength="15" value="<?= $_SESSION['usuario'] ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label>Foto de perfil:</label>
                                <input type="file" name="foto_perfil" class="form-control">
                                
                            </div>
                            
                            <div class="mb-3">
                                <label>Bio:</label>
                                <textarea class="form-control" name="bio" maxlength="32"><?= $_SESSION['bio'] ?></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-secondary">Salvar</button>
                            
                        </form>
                    </div>
                    
                </div>
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
                    <small id="contador" style="color: #aaa;">0 / 200</small>
                    <div id="mensagem_sucesso" class="text-success fw-bold mt-2" style="display: none;"></div>
                </div>
            </div>

            <div id="tags" class="list-group"></div>
        </div>

        <!-- Buscar Pessoas -->
        <div class="col-md-3 buscar-pessoas">
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
        
				

    </div>
</div>
<div class="modal fade" id="ResponderModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="tags_post" style="padding: 100px;">
                        <div class="d-flex align-items-center mb-3">
                            <img src="uploads/perfil/<?= $foto ?>" 
                                class="rounded-circle me-3" 
                                width="50" height="50">

                            <h5>
                                <?= htmlspecialchars($registro['usuario']) ?>
                                <small>#<?= $registro['id_usuario'] ?></small>
                            </h5>
                        </div>

                        <p class="text-muted"><?= htmlspecialchars($registro['data_formatada']) ?></p>

                        <div class="border rounded p-3 mb-4">
                            <?= nl2br(htmlspecialchars($registro['tag'])) ?>
                        </div>

                        <form method="post" action="responder_post.php">
                            <input type="hidden" name="resposta_de" value="<?= $id_tag ?>">

                            <textarea name="texto" class="form-control"
                                    maxlength="200" placeholder="Digite sua resposta..." required></textarea>

                            <button class="btn btn-primary mt-3">Responder</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>



<!-- Fundo escuro -->
<div id="overlayResponder" 
     style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
            background:rgba(0, 0, 0, 0.91); z-index:9998;">
</div>

<!-- Janelinha central -->
<div id="modalResponder" 
     style="display:none; position:fixed; top:50%; left:50%;
            transform:translate(-50%, -50%);
            width:800px; max-width:90%;
            background:black; padding:20px; border-radius:10px;
            box-shadow:0 0 20px rgba(0,0,0,.3); z-index:9999;">
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script> new WOW().init(); </script>

<script>
$(document).on("click", ".abrirResponder", function(e){
    e.preventDefault();

    let id_tag = $(this).data("id");

    $("#overlayResponder").fadeIn(200);
    $("#modalResponder").fadeIn(200).html("<p>Carregando...</p>");

    $.get("responder.php?id=" + id_tag, function(retorno){
        $("#modalResponder").html(retorno);
    });
});

// fechar clicando fora
$("#overlayResponder").on("click", function(){
    $("#overlayResponder").fadeOut(200);
    $("#modalResponder").fadeOut(200);
});



// Fechar janela quando clicar fora
document.addEventListener("click", function(e){
    const janela = document.getElementById("janelaResponder");

    if(e.target === janela) return;

    // fecha se clicar fora
    if(!janela.contains(e.target) && !e.target.classList.contains("abrirResponder")){
        janela.style.right = "-500px";
    }
});


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

    const input = document.getElementById('texto_tag');
    const contador = document.getElementById('contador');
    const limite = 200;

    input.addEventListener('input', ()=> {
        let total = input.value.length;


        ///atualiza contador
        contador.textContent = `${total} / ${limite} caracteres`;

        ///segurança extra para impedir ultrapassar colando texto grande

        if (total > limite){
            input.value = input.value.substring(0, limite);
        }
    });

</script>

</body>
</html>