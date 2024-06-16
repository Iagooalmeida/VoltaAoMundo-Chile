<?php
class Comentario{
    private $id;
    private $nome;
    private $email;
    private $comentario;
    public $data;
    public $status;
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getComentario(){
        return $this->comentario;
    }

    public function setComentario($comentario){
        $this->comentario = $comentario;
    }

    public function gravarComentario() {
        try {
            $sql = "INSERT INTO tb_comentarios (nome, email, comentario, status, data_cad) VALUES (:nome, :email, :comentario, :status, NOW())";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':comentario', $this->comentario);
            $stmt->bindValue(':status', $this->status);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao gravar comentário: " . $e->getMessage();
            return false;
        }
    }

    public function listarComentarios(){
        try{
            $sql = "SELECT * FROM tb_comentarios ORDER BY id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e){
            echo "Erro ao listar comentários: " . $e->getMessage();
            return false;
        }
    }

    public function alterarStatus($conn, $id, $status) {
        try {
            $sql = "UPDATE tb_comentarios SET status = :status WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':status', $status);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao alterar status: " . $e->getMessage();
            return false;
        }
    }

}
?>