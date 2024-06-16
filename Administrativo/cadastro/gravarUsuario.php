<?php
require_once '../../sql/conexao.php';
require_once '../../Class/Usuario.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login/");
    exit();
}

$response = ['success' => false, 'message' => ''];

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nomeCompleto = isset($_POST['nome']) ? trim($_POST['nome']) : null;
        $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : null;
        $telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : null;
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : null;
        $confirmarSenha = isset($_POST['confirmar_senha']) ? trim($_POST['confirmar_senha']) : null;
        

        if (empty($nomeCompleto) || empty($usuario) || empty($email) || empty($senha) || empty($confirmarSenha)) {
            $response['message'] = 'Por favor, preencha todos os campos.';
            echo json_encode($response);
            exit();
        }

        if ($senha !== $confirmarSenha) {
            $response['message'] = 'Senhas não conferem.';
            echo json_encode($response);
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response['message'] = 'Email inválido.';
            echo json_encode($response);
            exit();
        }

        $usuarioObj = new Usuario($conn);
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $result = $usuarioObj->gravarUsuario($nomeCompleto, $usuario, $telefone, $email, $senhaHash);

        if ($result === true) {
            $response['success'] = true;
            $response['message'] = 'Usuário cadastrado com sucesso.';
        } elseif ($result === false) {
            $response['message'] = 'Usuário já cadastrado.';
        } else {
            $response['message'] = $result;
        }
    } else {
        $response['message'] = 'Método de solicitação inválido.';
    }
} catch (Exception $e) {
    $response['message'] = 'Erro ao processar a solicitação: ' . $e->getMessage();
}

echo json_encode($response);
?>