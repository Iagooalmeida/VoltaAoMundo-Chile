<?php
require_once '../sql/conexao.php';
require_once '../Class/Comentario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['jsonFile'])) {
    $fileTmpPath = $_FILES['jsonFile']['tmp_name'];
    $fileName = $_FILES['jsonFile']['name'];
    $fileSize = $_FILES['jsonFile']['size'];
    $fileType = $_FILES['jsonFile']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    if ($fileExtension == 'json') {
        $jsonData = file_get_contents($fileTmpPath);
        $data = json_decode($jsonData, true);

        if ($data !== null) {
            $success = true;
            $conn->beginTransaction();
            try {
                foreach ($data as $comentarioData) {
                    $nome = $comentarioData['nome'];
                    $email = $comentarioData['email'];
                    $comentario = $comentarioData['comentario'];
                    $status = 'Pendente';

                    $comentarioObj = new Comentario($conn, $nome, $email, $comentario, $status);
                    $comentarioObj->setNome($nome);
                    $comentarioObj->setEmail($email);
                    $comentarioObj->setComentario($comentario);
                    $comentarioObj->status = $status;
                    $comentarioObj->gravarComentario();
                }
                $conn->commit();
            } catch (Exception $e) {
                $conn->rollBack();
                $success = false;
                $message = 'Erro ao importar comentários: ' . $e->getMessage();
            }

            if ($success) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => $message]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao decodificar o arquivo JSON.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Por favor, faça upload de um arquivo JSON válido.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Nenhum arquivo enviado.']);
}
?>
