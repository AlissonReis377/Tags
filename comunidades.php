<?php 

class Comunidade{
    private $nome;
    private $descricao;
    private $conexao;



    public function __construct($nome, $descricao, $conexao)
    {
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->conexao = $conexao;

    }

    public function salvar(){
        $sql = "INSERT INTO comunidades (nome, descricao) VALUES (?, ?, ?)";
        $stmt = $this->conexao->prepare($sql);

        if ($stmt){
            $stmt->bind_param("sss", $this->nome, $this->descricao);
            return $stmt->execute();
        }else{
            return false;
        }
    }

    public function comunidadeExiste(){ //metodo para verificar se usuario existe na hora do cadastro
        $sql = "SELECT nome_comunidade FROM comunidades WHERE nome_comunidade  = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param('s', $this->nome);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function listarComunidades(){
        $sql = "SELECT * FROM comunidades";
        $stmt = $this->conexao->prepare($sql);

        if ($stmt) {
            $stmt->execute();
            $resultado = $stmt->get_result();
            $comunidades = [];

            while ($row = $resultado->fetch_assoc()) {
                $comunidades[] = $row;
            }

            return $comunidades;
        }

        return [];
    }

}




?>