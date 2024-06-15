<?php
require_once '../sql/conexao.php';
require_once '../Class/Comentario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lê o corpo da solicitação
    $data = json_decode(file_get_contents("php://input"), true);
    $id = isset($data['id']) ? intval($data['id']) : null;
    $status = 'Aprovado';

    if ($id !== null) {
        $comentarioObj = new Comentario($conn);
        if ($comentarioObj->alterarStatus($conn, $id, $status)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao aprovar comentário.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID inválido.']);
    }
}
?>
