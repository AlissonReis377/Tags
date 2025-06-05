<?php

    session_start();//usar session no inicio sempre

    require_once('Usuario.class.php'); //puxa a classe de usuario e seus metodos
    require_once('db.class.php'); //puxa a conexão com banco de dados
    $usuario = $_POST['usuario'];
    $senha = md5($_POST['senha']); //md5 para criptografar a senha

    $objDb = new Db();
    $link = $objDb->conecta_mysql();

    $usuarioObj = Usuario::autenticarUsuario($usuario, $senha, $link); //criei uma instancia especifica para o login pq a outra tava dando erro
    $dados_usuario = $usuarioObj->autenticar();

    if($dados_usuario){

        $_SESSION['id'] = $dados_usuario['Id_usuario']; // <- Aqui pega o ID
        $_SESSION['usuario'] = $dados_usuario['usuario']; //para manter a sessão do usuario quando tiver conectado
        $_SESSION['email'] = $dados_usuario['email'];

        header('Location: home.php');
    }else{
        header('Location: index.php?erro=1');
    }
?>