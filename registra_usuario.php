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

$objDb = new Db();
$link = $objDb->conecta_mysql();

$usuarioObj = new Usuario($usuario, $email, $senha, $username, $telefone, $bio, $data_nasc, $endereco, $link);

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