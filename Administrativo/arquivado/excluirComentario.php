<?php
    require_once '../../Class/Comentario.php';
    require_once '../../sql/conexao.php';

    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location: ../login/');
        exit();
    }

    if (isset($_GET['id']) && is_numeric($_GET['id'])){
        $comentarioId = $_GET['id'];
        $comentario = new Comentario($conn);

        if ($comentario->excluirComentario($comentarioId)) {
            $_SESSION['mensagem'] = [
                'tipo' => 'success',
                'titulo' => 'Sucesso!',
                'texto' => 'Comentário excluído com sucesso!'
            ];
        } else {
            $_SESSION['mensagem'] = [
                'tipo' => 'error',
                'titulo' => 'Erro!',
                'texto' => 'Erro ao excluir comentário. Tente novamente.'
            ];
        }
    } else {
        $_SESSION['mensagem'] = [
            'tipo' => 'error',
            'titulo' => 'Erro!',
            'texto' => 'ID de comentário inválido.'
        ];
    }

    header("Location: index.php");
    exit();
?>