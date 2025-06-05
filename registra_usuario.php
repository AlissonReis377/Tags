<?php
require_once('db.class.php');
require_once('Usuario.class.php');

$usuario = $_POST['usuario'];
$email = $_POST['email'];
$senha = md5($_POST['senha']); //md5 no php criptografa a senha

$objDb = new Db();
$link = $objDb->conecta_mysql();

$usuarioObj = new Usuario($usuario, $email, $senha, $link);

$usuario_existe = false; //se o usuario existir o valor recebe false pq no if ali de baixo ele vai ficar true pra ativar o bagulhinho de erro no inscrevase.php
$email_existe = false;

if($usuarioObj->usuarioExiste()){
    $usuario_existe = true;
}
if ($usuarioObj->emailExiste()){
    $email_existe = true;
}

if($usuario_existe || $email_existe){ 

    $retorno_get = '';

    if($usuario_existe){
        $retorno_get.= "erro_usuario=1&";
    }
    if($email_existe){
        $retorno_get.= "erro_email=1&";
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