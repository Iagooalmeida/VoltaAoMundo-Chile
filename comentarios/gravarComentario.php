<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <?php
    require_once '../sql/conexao.php';
    require_once '../Class/Comentario.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = isset($_POST["nome"]) ? trim($_POST["nome"]) : null;
        $email = isset($_POST["email"]) ? trim(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL)) : null;
        $comentario = isset($_POST["comentario"]) ? trim($_POST["comentario"]) : null;
        $status = "Pendente";

        try {
            if (empty($nome) || empty($email) || empty($comentario)) {
                throw new Exception("Por favor, preencha todos os campos.");
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Por favor, insira um email válido.");
            }

            $comentarioObj = new Comentario($conn);
            $comentarioObj->setNome($nome);
            $comentarioObj->setEmail($email);
            $comentarioObj->setComentario($comentario);
            $comentarioObj->status = $status;

            $cadastrarComentario = $comentarioObj->gravarComentario();

            if ($cadastrarComentario) {
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: 'Comentário enviado com sucesso.',
                    }).then(() => {
                       window.location.href = 'index.php';
                    });
                </script>";

            } else {
                throw new Exception("Erro ao enviar comentário.");
            }
        } catch (Exception $e) {
            echo '<script>';
            echo 'alert("' . $e->getMessage() . '");';
            // echo 'window.location.href = "index.php";';
            echo '</script>';
        }
    }
    ?>
</body>
</html>

