<?php

class Db {

    //host
    private $host = 'localhost';
    //usuario
    private $user = 'root';
    //senha
    private $pass = '';
    //banco de dados
    private $database = 'tags'; 


    //metodo de conexão com o banco de dados
    public function conecta_mysql(){
        
        //criar a conexão
        $conn = mysqli_connect($this->host, $this->user, $this->pass, $this->database); //reusabilidade de código pq peguei as variaveis que já estão declaradas a cima 
        
        //ajustar o charset de comunicação entre aplicação e o bd
        mysqli_set_charset($conn, 'utf8'); //evita erros de caracteres pelo amor não mudar isso se não tamo lascado

        //verificador de erro de conexão
        if(mysqli_connect_errno()){
            echo 'Houve um erro ao tentar se conectar com banco de dados: '.mysqli_connect_error(); //se tiver algum erro vai mostrar para o usuario
        }

        return $conn;
    }
}

?>