<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    exit("erro");
}

require_once('db.class.php');

$id_usuario = $_SESSION['id'];
$nome       = trim($_POST['nome']);
$bio        = trim($_POST['bio']);


//conexao com bando de dados

$objDb = new Db();
$link = $objDb->conecta_mysql();


//atualizar nome e bio

$sql = "UPDATE usuarios SET usuario = ?, bio = ? WHERE id_usuario = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "ssi", $nome, $bio, $id_usuario);
mysqli_stmt_execute($stmt);


//Processar foto de perfil (se for enviada)

if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == 0){
      
    // --- LIMITE DE TAMANHO (2MB) ---
    $maxSize = 2 * 1024 * 1024; // 2MB

    if ($_FILES['foto_perfil']['size'] > $maxSize) {
        echo "<script>
            alert('A imagem deve ter no máximo 2MB!');
            window.location.href = 'home.php';
        </script>";
        exit;
    }

    // --- LIMITE DE DIMENSÕES (800x800) ---
    list($w, $h) = getimagesize($_FILES['foto_perfil']['tmp_name']);

    if ($w > 800 || $h > 800) {
        echo "<script>
            alert('A imagem deve ter no máximo 800x800 pixels!');
            window.location.href = 'home.php';
        </script>";
        exit;
    }



    $ext = strtolower(pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION));
    $permitidas = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($ext, $permitidas)) {




        // Nome único da imagem
        $novoNome = 'perfil_' . $id_usuario . '_' . time() . '.' . $ext;

        // Pasta onde vai salvar
        $destino = 'uploads/perfil/' . $novoNome;

        // Criar pasta se não existir
        if (!is_dir('uploads/perfil')) {
            mkdir('uploads/perfil', 0777, true);
        }

        // Mover arquivo
        if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $destino)) {

            // Atualizar no banco
            $sqlFoto = "UPDATE usuarios SET foto_perfil = ? WHERE id_usuario = ?";
            $stmtFoto = mysqli_prepare($link, $sqlFoto);
            mysqli_stmt_bind_param($stmtFoto, "si", $novoNome, $id_usuario);
            mysqli_stmt_execute($stmtFoto);
        }
    }
        //Pega todas as fotos que estão em uso
        $usadas = [];
        $sql = "SELECT foto_perfil FROM usuarios WHERE foto_perfil IS NOT NULL";
        $resultado = mysqli_query($link, $sql);
        while($row = mysqli_fetch_assoc($resultado)){
            $usadas[] = $row['foto_perfil'];
        }

        //Lista todos os arquivos da pasta
        $pasta = 'uploads/perfil/';
        $arquivos = scandir($pasta);

        //Nome da foto padrão
        $default = 'default.jpg';

        //Apaga somente arquivos que não estão sendo usados e não são a default
        foreach($arquivos as $arquivo){
            if($arquivo != '.' && $arquivo != '..'){
                if(!in_array($arquivo, $usadas) && $arquivo != $default){
                    unlink($pasta . $arquivo);
                }
            }
        }




}


//atualiza a sessão
$_SESSION['usuario'] = $nome;
$_SESSION['bio'] = $bio;

header("Location: home.php?editado=1");
exit;
