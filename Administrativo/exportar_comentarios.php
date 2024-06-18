<?php
require_once '../sql/conexao.php';
require_once '../Class/Comentario.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="comentarios.csv"');

$output = fopen('php://output', 'w');
fputcsv($output, array('ID', 'Nome', 'Email', 'Comentario', 'Data', 'Status'));

$comentario = new Comentario($conn);
$comentarios = $comentario->listarComentarios($conn);

foreach ($comentarios as $comentario) {
    fputcsv($output, $comentario);
}

fclose($output);
exit();
?>
