<?php
session_start(); // Inicia a sessão
require_once '../sql/conexao.php';
require_once '../Class/Usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = isset($_POST["username"]) ? trim($_POST["username"]) : null;
    $senha = isset($_POST["password"]) ? trim($_POST["password"]) : null;

    if (!empty($usuario) && !empty($senha)) {
        $usuarioObj = new Usuario($conn, $usuario, $senha, null, null);
        $usuarioObj->validarLogin();
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>
