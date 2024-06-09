<?php
class Comentario{
    private $id;
    private $nome;
    private $email;
    private $comentario;
    public $data;
    public $status;
    private $conn;

    public function __construct($conn, $nome, $email, $comentario, $status){
        $this->nome = $nome;
        $this->email = $email;
        $this->comentario = $comentario;
        $this->status = $status;
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

    public function gravarComentario(){
        try{
            $sql = "INSERT INTO tb_comentarios (nome, email, comentario, status, data_cad) VALUES (:nome, :email, :comentario, :status, NOW())";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':comentario', $this->comentario);
            $stmt->bindValue(':status', $this->status);
            $stmt->execute();
            return true;
        } catch (PDOException $e){
            echo "Erro ao gravar comentário: " . $e->getMessage();
            return false;
        }
    }

}
?>