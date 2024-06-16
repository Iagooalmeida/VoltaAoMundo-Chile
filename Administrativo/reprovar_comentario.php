<?php
require_once '../sql/conexao.php';
require_once '../Class/Comentario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lê o corpo da solicitação
    $data = json_decode(file_get_contents("php://input"), true);
    $id = isset($data['id']) ? intval($data['id']) : null;
    $status = 'Arquivado';

    if ($id !== null) {
        $comentarioObj = new Comentario($conn);
        if ($comentarioObj->alterarStatus($id, $status)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao reprovar comentário.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID inválido.']);
    }
}
?>
