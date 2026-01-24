<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('location: index.php?erro=1');
    exit;
}

require_once('db.class.php');

$objDb = new Db();
$link = $objDb->conecta_mysql();

$id_usuario = $_SESSION['id'];

// foto perfil
$sql = "SELECT foto_perfil FROM usuarios WHERE id_usuario = $id_usuario";
$res = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($res);
$fotoPerfil = $row['foto_perfil'] ?? 'default.jpg';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Tags!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="style/stylehome.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>

<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-expand-lg navbar-glass">
    <div class="navbar-inner">

        <div class="d-flex align-items-center gap-2">
            <img src="imagens/tags.png" width="40">
            <img src="uploads/perfil/<?= $fotoPerfil ?>"
                 class="rounded-circle"
                 style="width:50px;height:50px;object-fit:cover;">
                 <a class="nav-link" href="perfil_usuario.php" style="color: white;">
                     <?= $_SESSION['usuario'] ?> <small>#<?= $_SESSION['id'] ?></small>
                 </a>
        </div>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                </li>
                <li class="nav-item"><a class="nav-link" href="buscar.php">Buscar</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#editarPerfilModal">
                        Editar perfil
                    </a>
                </li>
                <li class="nav-item"><a class="nav-link" href="sair.php">Sair</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- ================= CONTEÚDO ================= -->
<div class="container mt-4">
    <div class="row justify-content-center">

        <div class="col-12 col-md-8 criar-tag-container">

            <!-- CRIAR TAG -->
            <div class="card tag_criar mb-3">
                <div class="card-body">
                    <form id="form_tag">
                        <textarea id="texto_tag"
                                  name="texto_tag"
                                  class="form-control"
                                  placeholder="Comece suas Tags!"
                                  maxlength="200"></textarea>
                    </form>

                    <small id="contador">0 / 200</small>
                    <hr>

                    <p class="text-muted">
                        Siga as regras de postagem.  
                        Não serão aceitas tags com cunho preconceituoso.
                    </p>

                    <button class="btn btn-secondary w-100" id="btn_tag">
                        Fazer Tag
                    </button>

                    <div id="mensagem_sucesso"
                         class="text-success fw-bold mt-2"
                         style="display:none;">
                    </div>
                </div>
            </div>

            <!-- TAGS -->
            <div id="tags"></div>

        </div>
    </div>
</div>

<!-- ================= MODAL EDITAR PERFIL ================= -->
<div class="modal fade" id="editarPerfilModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Editar Perfil</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="text-center mb-3">
                    <img src="uploads/perfil/<?= $fotoPerfil ?>"
                         class="rounded-circle"
                         width="150" height="150"
                         style="object-fit:cover;">
                </div>

                <form method="POST" action="editar_perfil.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label>Nome</label>
                        <input type="text" name="nome" class="form-control"
                               maxlength="15" value="<?= $_SESSION['usuario'] ?>">
                    </div>

                    <div class="mb-3">
                        <label>Foto</label>
                        <input type="file" name="foto_perfil" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Bio</label>
                        <textarea name="bio" class="form-control" maxlength="32"><?= $_SESSION['bio'] ?></textarea>
                    </div>

                    <button class="btn btn-secondary w-100">Salvar</button>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- ================= SCRIPTS ================= -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
const input = document.getElementById('texto_tag');
const contador = document.getElementById('contador');
const limite = 200;

input.addEventListener('input', () => {
    let total = input.value.length;
    contador.textContent = `${total} / ${limite}`;

    contador.style.color =
        total >= 180 ? 'red' :
        total >= 150 ? 'orange' : '#aaa';
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
    $.get('get_tag.php', function(data){
        $('#tags').html(data);
    });
}
atualizaTag();
</script>

</body>
</html>
