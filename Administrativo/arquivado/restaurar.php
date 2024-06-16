<?php
require_once '../../Class/Comentario.php';
require_once '../../sql/conexao.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $comentarioId = $_GET['id'];
    $comentario = new Comentario($conn);
    $status = "Pendente";

    if ($comentario->alterarStatus($comentarioId, $status)) {
        echo "<!DOCTYPE html>
        <html lang='pt-BR'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Restaurar Comentário</title>
            <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css'>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: 'Comentário restaurado com sucesso!',
                }).then(function() {
                    window.location.href = 'index.php';
                });
            </script>
        </body>
        </html>";
    } else {
        echo "<!DOCTYPE html>
        <html lang='pt-BR'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Erro ao Restaurar Comentário</title>
            <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css'>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: 'Erro ao restaurar comentário. Tente novamente.',
                }).then(function() {
                    window.location.href = 'index.php';
                });
            </script>
        </body>
        </html>";
    }
} else {
    echo "<!DOCTYPE html>
    <html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>ID de Comentário Inválido</title>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css'>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'ID de comentário inválido.',
            }).then(function() {
                window.location.href = 'index.php';
            });
        </script>
    </body>
    </html>";
}
?>
