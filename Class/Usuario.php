<?php
class Usuario {
    private $id;
    private $nomeCompleto;
    private $usuario;
    public $telefone;
    private $email;
    private $senha;
    private $conn;
    
    public function __construct($conn)
    {
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

    public function validarLogin($usuario, $senha) {
        try {

            $sql = "SELECT * FROM tb_users WHERE usuario = :usuario";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if (password_verify($senha, $row['senha'])) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['nomeCompleto'] = $row['nomeCompleto'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['usuario'] = $row['usuario'];

                    echo "Login realizado com sucesso!";
                    header("Location: ../Administrativo/");
                    exit();
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

    public function gravarUsuario($nomeCompleto, $usuario, $telefone, $email, $senhaHash) {
        try {
            $sql = "SELECT id FROM tb_users WHERE usuario = :usuario";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return false; // Usuário já cadastrado
            } else {
                $sql = "INSERT INTO tb_users (nomeCompleto, usuario, telefone, email, senha) VALUES (:nomeCompleto, :usuario, :telefone, :email, :senha)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':nomeCompleto', $nomeCompleto);
                $stmt->bindParam(':usuario', $usuario);
                $stmt->bindParam(':telefone', $telefone);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':senha', $senhaHash);
                $stmt->execute();

                return true;
            }
        } catch (PDOException $e) {
            return "Erro: " . $e->getMessage();
        }
    }
}
?>