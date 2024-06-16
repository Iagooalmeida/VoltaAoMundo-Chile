<?php
require_once '../Class/Comentario.php';
require_once '../sql/conexao.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comentarioId = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $comentarioTexto = $_POST['comentario'];

    $comentario = new Comentario($conn);
    if ($comentario->editarComentario($comentarioId, $nome, $email, $comentarioTexto)) {
        $_SESSION['mensagem'] = [
            'tipo' => 'success',
            'titulo' => 'Sucesso!',
            'texto' => 'Comentário editado com sucesso!'
        ];
    } else {
        $_SESSION['mensagem'] = [
            'tipo' => 'error',
            'titulo' => 'Erro!',
            'texto' => 'Erro ao editar comentário. Tente novamente.'
        ];
    }

    header("Location: index.php");
    exit();
}
?>
