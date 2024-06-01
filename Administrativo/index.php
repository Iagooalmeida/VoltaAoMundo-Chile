<?php
require_once '../sql/conexao.php';
require_once '../Class/Usuario.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    // Se não estiver autenticado, redirecione para a página de login
    header("Location: ../login/");
    exit();
}
?>