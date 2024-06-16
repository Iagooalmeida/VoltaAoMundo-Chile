<?php
    require_once '../../Class/Comentario.php';
    require_once '../../sql/conexao.php';


    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location: ../login/');
        exit();
    }

    $comentario = new Comentario($conn);
    $comentarios = $comentario->listarComentarios($conn);

    $mensagem = '';
    if (isset($_SESSION['mensagem'])) {
        $mensagem = $_SESSION['mensagem'];
        unset($_SESSION['mensagem']); 
    }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentários Arquivados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <head>
        <div class="d-flex justify-content-end align-items-center gap-3 bg-chile p-2 pe-md-5 bg-chile" style="height: 5em;">
            <h2 class="text-center fs-4">Bem-vindo, <?php echo explode(' ', $_SESSION['nomeCompleto'])[0]; ?></h2>
        </div>
        <nav>
            <ul class="menu">
                <li title="home"><a href="#" class="menu-button home">menu</a></li>
                <li title="search"><a href="#" class="search">search</a></li>
                <li title="pencil"><a href="#" class="pencil">pencil</a></li>
                <li title="about"><a href="../../cadastro/" class="active about">about</a></li>
                <li title="archive"><a href="#" class="archive">archive</a></li>
                <li title="contact"><a href="#" class="contact">contact</a></li>
                <li title="logout"><a href="../login/logout.php" class="logout">logout</a></li>
            </ul>
            <ul class="menu-bar">
                <li><a href="#" class="menu-button">Menu</a></li>
                <li><a href="../">Home</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Editorial</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </nav>
    </head>
    <main class="content">
        <div class="container mt-5">
            <h1 class="pb-md-5">Comentarios arquivados</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Comentário</th>
                        <th scope="col">Data</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $contador = 1;
                    foreach ($comentarios as $comentario) :
                        if ($comentario['status'] == 'Arquivado') {
                    ?>
                            <tr>
                                <th scope="row"><?php echo $contador++; ?></th>
                                <td><?php echo $comentario['nome']; ?></td>
                                <td><?php echo $comentario['email']; ?></td>
                                <td><?php echo $comentario['comentario']; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($comentario['data_cad'])); ?></td>
                                <td><?php echo $comentario['status']; ?></td>
                                <td>
                                    <a href="restaurar.php?id=<?php echo $comentario['id']; ?>" class="btn btn-success">Restaurar</a>
                                    <a href="excluir.php?id=<?php echo $comentario['id']; ?>" class="btn btn-danger">Excluir</a>
                                </td>
                            </tr>
                    <?php
                    $contador++;
                        }
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <?php if ($mensagem): ?>
    <script>
        Swal.fire({
            icon: '<?php echo $mensagem['tipo']; ?>',
            title: '<?php echo $mensagem['titulo']; ?>',
            text: '<?php echo $mensagem['texto']; ?>',
        });
    </script>
    <?php endif; ?>

    <script>
        $(document).ready(function(){
            $(".menu-button").click(function(){
                $(".menu-bar").toggleClass("open");
                $(".content").toggleClass("menu-expanded");
            });
        });
    </script>
</body>
</html>