<?php
class Tag {
    private $conexao; //tudo encapsuladinho olha que fofura
    private $id_usuario;
    private $texto;

    public function __construct($id_usuario, $texto, $conexao) { //metodo construtor para as tags
        $this->id_usuario = $id_usuario;
        $this->texto = $texto;
        $this->conexao = $conexao;
    }

    public function salvar() {
        if (empty($this->texto) || empty($this->id_usuario)) { //verifica se o conteudo é vazio se for ele retorna falso impedindo de fazer a tag
            return false;
        }

        $sql = "INSERT INTO tag(id_usuario, tag) VALUES (?, ?)"; //assim pra evitar SQL injection de novo
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("is", $this->id_usuario, $this->texto);
        return $stmt->execute();
    }

    public static function deletarPorId($id_tag, $id_usuario, $conexao) { //metodo para apagar a tag == post
        $sql = "DELETE FROM tag WHERE id_tag = ? AND id_usuario = ?"; 
        $stmt = $conexao->prepare($sql); 
        $stmt->bind_param("ii", $id_tag, $id_usuario); //recebe os dois id's 
        return $stmt->execute();
    }

}




?>