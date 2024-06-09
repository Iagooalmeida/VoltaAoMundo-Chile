<?php
class Usuario {
    private $id;
    private $nomeCompleto;
    private $usuario;
    private $email;
    private $senha;
    private $conn;
    
    public function __construct($conn, $usuario, $senha, $nomeCompleto = null, $email = null) {
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->nomeCompleto = $nomeCompleto;
        $this->email = $email;
        $this->conn = $conn;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getNome() {
        return $this->nomeCompleto;
    }
    
    public function setNome($nomeCompleto) {
        $this->nomeCompleto = $nomeCompleto;
    }
    
    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getEmail() {
        return $this->email;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function getSenha() {
        return $this->senha;
    }
    
    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function validarLogin() {
        try {
            $sql = "SELECT id, nomeCompleto, email, senha FROM tb_users WHERE usuario = :usuario";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':usuario', $this->usuario);
            $stmt->execute();
            
            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($this->senha === $row['senha']) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['nomeCompleto'] = $row['nomeCompleto'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['usuario'] = $this->usuario;

                    echo "Login realizado com sucesso!";
                    header("Location: ../Administrativo/" );
                } else {              
                    echo "Senha incorreta.";
                }
            } else {
                echo "Usuário não encontrado.";
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>