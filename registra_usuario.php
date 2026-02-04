<?php
require_once('db.class.php');
require_once('Usuario.class.php');

$usuario = $_POST['usuario'];
$email = $_POST['email'];
$senha = md5($_POST['senha']); //md5 no php criptografa a senha
$username = $_POST['username'];
$telefone = $_POST['telefone'];
$bio = $_POST['bio'];
$data_nasc = $_POST['dt_nasc'];
$endereco = $_POST['endereco'];


$fotoPerfil = '';

$fotoPerfil = '';

if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == 0) {

    // --- LIMITE DE TAMANHO (2MB) ---
    $maxSize = 2 * 1024 * 1024; // 2MB

    if ($_FILES['foto_perfil']['size'] > $maxSize) {
        echo "<script>
            alert('A imagem deve ter no máximo 2MB!');
            window.location.href = 'inscrevase.php';
        </script>";
        exit;
    }

    // --- LIMITE DE DIMENSÕES (800x800) ---
    list($w, $h) = getimagesize($_FILES['foto_perfil']['tmp_name']);

    if ($w > 800 || $h > 800) {
        echo "<script>
            alert('A imagem deve ter no máximo 800x800 pixels!');
            window.location.href = 'inscrevase.php';
        </script>";
        exit;
    }

    // --- EXTENSÃO ---
    $ext = pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION);
    $ext = strtolower($ext);

    $permitidas = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($ext, $permitidas)) {
        echo "<script>
            alert('Formato inválido! Use JPG, JPEG, PNG ou GIF.');
            window.location.href = 'inscrevase.php';
        </script>";
        exit;
    }

    // --- SALVAR A IMAGEM ---
    $novoNome = uniqid().".".$ext;

    if (!is_dir("uploads/perfil")) {
        mkdir("uploads/perfil", 0777, true);
    }

    move_uploaded_file($_FILES['foto_perfil']['tmp_name'], "uploads/perfil/" . $novoNome);
    $fotoPerfil = $novoNome;
    
}


$objDb = new Db();
$link = $objDb->conecta_mysql();

$usuarioObj = new Usuario($usuario, $email, $senha, $username, $telefone, $bio, $data_nasc, $endereco, $fotoPerfil, $link);

$usuario_existe = false; //se o usuario existir o valor recebe false pq no if ali de baixo ele vai ficar true pra ativar o bagulhinho de erro no inscrevase.php
$email_existe = false;
$username_existe = false;

if($usuarioObj->usuarioExiste()){
    $usuario_existe = true;
}
if ($usuarioObj->emailExiste()){
    $email_existe = true;
}

if ($usuarioObj->username()){
    $username_existe = true;
}



if($usuario_existe || $email_existe || $username_existe){ 

    $retorno_get = '';

    if($usuario_existe){
        $retorno_get.= "erro_usuario=1&";
    }
    if($email_existe){
        $retorno_get.= "erro_email=1&";
    }
    if($username_existe){
        $retorno_get.= "erro_username=1&";
    }

    header('Location: inscrevase.php?'.$retorno_get);
    die();
}

$data_nasc = $_POST['dt_nasc'];

$hoje = new DateTime();
$nascimento = new DateTime($data_nasc);
$idade = $hoje->diff($nascimento)->y;

if ($idade < 18) {
  header("Location: inscrevase.php?erro_idade=1");
  exit;
}




if($usuarioObj->salvar()){
echo "<script>
    alert('Usuário cadastrado com sucesso!');
    window.location.href = 'index.php';
</script>";
}else{
echo "<script>
    alert('Erro ao cadastrar usuario!');
    window.location.href = 'index.php';
</script>";
}

?>