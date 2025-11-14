<?php

//fiz uma classe para usuario, vai evitar SQL injection e da mais desempenho nessa budega
class Usuario{
    private $usuario; //nome do usuario informado pelo formulario
    private $email; //email informado
    private $senha; //senha informado
    private $conexao; //conexao recebida do db.class.php
    private $username;
    private $telefone;
    private $bio;
    private $data_nascimento;
    private $endereco;


    public function __construct($usuario, $email, $senha, $username, $telefone, $bio, $data_nasc, $endereco, $conexao)//metodo construtor para o objeto usuario
    {
        $this->usuario = $usuario;  //esse metodo vai ser chamado automaticamente quando
        $this->email = $email;      //criar um novo usuario, ele constroi e guarda os valores
        $this->senha = $senha;      //passados nos atributos da classe
        $this->username = $username;
        $this->telefone = $telefone;
        $this->bio = $bio;
        $this->data_nascimento = $data_nasc;
        $this->endereco = $endereco;
        $this->conexao = $conexao;
    }

    public static function autenticarUsuario($usuario, $senha, $conexao) { //metodo criado apenas para autenticar usuarios pq se manter do jeito que tava dá erro
        $instancia = new self($usuario, null, $senha, null, null, null, null, null, $conexao);
        return $instancia;
    }



    public function salvar(){
        $sql = "INSERT INTO USUARIOS (usuario, email, senha, username, endereco, dt_nasc, telefone, bio) VALUES (?, ?, ?, ?, ?, ?, ? ,?)"; //usa os pontos de interrogação onde os dados vão entrar
                                        //?,     ?,     ?,      ?,         ?,       ?,       ? ,     ?
        $stmt = $this->conexao->prepare($sql);

        if ($stmt){
            $stmt->bind_param("ssssssss", $this->usuario, $this->email, $this->senha , $this->username, $this->endereco, $this->data_nascimento, $this->telefone, $this->bio);
            return $stmt->execute();
        }else{
            return false;
        }
    }

    public function autenticar(){
        $sql = "SELECT * FROM usuarios WHERE usuario = ? AND senha = ?"; //os pontos de interrogação são placeholders que serão preenchidos depois com
        $stmt = $this->conexao->prepare($sql);//aqui ele prepara para o SQL executar de forma segura                           //bind_param, para evitar SQL injection

        if ($stmt) {
            $stmt->bind_param("ss", $this->usuario, $this->senha); //o ss indica que os dois parametros são strings
            $stmt->execute(); //e finalmente ele executa a consulta
            $resultado = $stmt->get_result(); //aqui ele obtem o resultado da consulta

            if ($resultado->num_rows > 0) { //aqui verifica se encontrou algo/usuario e senha iguais
                return $resultado->fetch_assoc(); //fetch_assoc retorna os dados do usuario como um array associativo exemplo 'usuario' => 'alisson_o_mais_lindo_de_todos'
            }
        }

        return false; //ai se nada for encontrado
    }

    public function usuarioExiste(){ //metodo para verificar se usuario existe na hora do cadastro
        $sql = "SELECT usuario FROM usuarios WHERE usuario = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param('s', $this->usuario);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function emailExiste(){ //metodo para verificar se email ja existe na hora do cadastro
        $sql = "SELECT email FROM usuarios WHERE email = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;

    }
    public function username(){
        $sql = "SELECT username FROM usuarios WHERE username = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("s", $this->username);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

}

?>