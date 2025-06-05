<?php
//classe para usar pesquisa do banco de dados
//NÃO MUDAR NADA NESSA CLASSE ALTO RISCO DE ACABAR COM TUDO TO MEXENDO NISSO JÁ TEM MAIS DE HORAS!!!!!!!!!!!!!!!!
class UsuarioDAO {
    private $conexao; //encapsulamento da conexão

    public function __construct($conexao) { //metodo construtor para conexão com banco de dados
        $this->conexao = $conexao;
    }

    public function buscarPessoas($nome_pessoa, $id_usuario_logado) { //metodo para buscar pessoas no banco de dados
        $nome_like = "%$nome_pessoa%"; //variavel do nome para usar na pesquisa do banco
        $sql = "SELECT u.usuario, u.email, u.id_usuario AS id_usuario, us.id_usuario_seguidor
                FROM usuarios AS u
                LEFT JOIN usuarios_seguidores AS us 
                  ON (us.id_usuario = ? AND u.id_usuario = us.seguindo_id_usuario)
                WHERE u.usuario LIKE ? AND u.id_usuario <> ?";

        $stmt = $this->conexao->prepare($sql); 
        if ($stmt) {
            $stmt->bind_param("ssi", $id_usuario_logado, $nome_like, $id_usuario_logado); //string, string, inteiro // //evita sql injection
            $stmt->execute();
            return $stmt->get_result();
        }
        return false;
    }
}

?>