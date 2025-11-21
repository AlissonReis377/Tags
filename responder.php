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

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responder</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="style/stylehome.css">

</head>
<body class="p-5">

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
</body>
</html>
