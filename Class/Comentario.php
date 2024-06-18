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
            $this->nome = $this->limparInput($this->nome);
            $this->email = $this->limparInput($this->email);
            $this->comentario = $this->limparInput($this->comentario);

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

    private function limparInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data= htmlspecialchars($data);
        return $data;
    }  

    public function listarComentarios(){
        try{
            $this->nome = $this->limparInput($this->nome);
            $this->email = $this->limparInput($this->email);
            $this->comentario = $this->limparInput($this->comentario);

            $sql = "SELECT * FROM tb_comentarios ORDER BY id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e){
            echo "Erro ao listar comentários: " . $e->getMessage();
            return false;
        }
    }

    public function alterarStatus($id, $status) {
        try {
            $sql = "UPDATE tb_comentarios SET status = :status WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':status', $status);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao alterar status: " . $e->getMessage();
            return false;
        }
    }

    public function excluirComentario($id) {
        try {
            $sql = "DELETE FROM tb_comentarios WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao excluir comentário: " . $e->getMessage();
            return false;
        }
    }

    public function editarComentario($id, $nome, $email, $comentario) {
        $sql = "UPDATE tb_comentarios SET nome = ?, email = ?, comentario = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nome, $email, $comentario, $id]);
    }

    public function contarComentarios($conn) {
        $sql = "SELECT COUNT(*) as total FROM tb_comentarios";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function listarComentariosPaginados($conn, $inicio, $limite) {
        $sql = "SELECT * FROM tb_comentarios LIMIT :inicio, :limite";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':inicio', $inicio, PDO::PARAM_INT);
        $stmt->bindParam(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>