<?php
require_once '../sql/conexao.php';
require_once '../Class/Usuario.php';
require_once '../Class/Comentario.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    
    header("Location: ../login/");
    exit();
}

$comentario = new Comentario($conn);
$comentarios = $comentario->listarComentarios($conn);

$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : null;
unset($_SESSION['mensagem'])

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>página Adminitrador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <header>
        <div class="d-flex justify-content-end align-items-center gap-3 bg-chile p-2 pe-md-5 bg-chile" style="height: 5em;">
            <h2 class="text-center fs-5">Bem-vindo, <?php echo explode(' ', $_SESSION['nomeCompleto'])[0]; ?></h2>
        </div>
        <nav>
            <ul class="menu">
                <li title="home"><a href="#" class="menu-button home">menu</a></li>
                <li title="search"><a href="#" class="search">search</a></li>
                <li title="pencil"><a href="#" class="pencil">pencil</a></li>
                <li title="about"><a href="cadastro/" class="active about">about</a></li>
                <li title="archive"><a href="arquivado/" class="archive">archive</a></li>
                <li title="contact"><a href="#" class="contact">contact</a></li>
                <li title="logout"><a href="../login/logout.php" class="logout">logout</a></li>
            </ul>
            <ul class="menu-bar">
                <li><a href="#" class="menu-button">Menu</a></li>
                <li><a href="#">Home</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Editorial</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </nav>      
    </header>
    <main class="content">
        <div class="container mt-5">
            <h1 class="pb-md-5">Painel Administrativo</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Comentário</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $contador = 1;
                    foreach($comentarios as $comentario): 
                        if ($comentario['status'] == 'Aprovado' || $comentario['status'] == 'Pendente') {
                    ?>
                        <tr>
                            <td><?php echo $contador; ?></td>
                            <td><?php echo $comentario['nome']; ?></td>
                            <td><?php echo $comentario['email']; ?></td>
                            <td><?php echo $comentario['comentario']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($comentario['data_cad'])); ?></td>
                            <td><?php echo $comentario['status']; ?></td>
                            <td>
                                <button class="btn btn-success btn-approve" data-id="<?php echo $comentario['id']; ?>" title="Aprovar">
                                    <ion-icon name="checkmark-outline"></ion-icon>
                                </button>
                                <button class="btn btn-danger btn-reject" data-id="<?php echo $comentario['id']; ?>" title="Reprovar">
                                    <ion-icon name="close-outline"></ion-icon>
                                </button>
                                <button class="btn btn-primary btn-edit" data-id="<?php echo $comentario['id']; ?>" data-nome="<?php echo $comentario['nome']; ?>" data-email="<?php echo $comentario['email']; ?>" data-comentario="<?php echo $comentario['comentario']; ?>" title="Editar">
                                    <ion-icon name="create-outline"></ion-icon>
                                </button>
                            </td>
                        </tr>
                    <?php 
                        $contador++;
                        }
                    endforeach; ?>
                </tbody>
            </table>
            <form id="uploadForm" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="jsonFile" class="form-label">Importar Comentários via JSON</label>
                        <input class="form-control" type="file" id="jsonFile" name="jsonFile" accept=".json">
                    </div>
                    <div class="col-md-4 mb-3 p-2">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="Pendente" disabled selected>Selecione uma opção</option>
                            <option value="Aprovado">Aprovar</option>
                            <option value="Pendente">Pendente</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Importar</button>
            </form>
        </div>
    </main>

            <!-- <form id="exportForm" method="POST">
                <button type="submit" class="btn btn-primary">Exportar</button>
            </form> -->
        </div>
    </main>
    <footer class="content">
        <!-- place footer here -->
    </footer>

    <!-- Modal de Edição -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" action="editarComentario.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar Comentário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editId">
                        <div class="mb-3">
                            <label for="editNome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="editNome" name="nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editComentario" class="form-label">Comentário</label>
                            <textarea class="form-control" id="editComentario" name="comentario" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" 
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    
    <script>
        $(document).ready(function(){
            $(".menu-button").click(function(){
                $(".menu-bar").toggleClass("open");
                $(".content").toggleClass("menu-expanded");
            });

            $(".btn-edit").click(function() {
                var id = $(this).data("id");
                var nome = $(this).data("nome");
                var email = $(this).data("email");
                var comentario = $(this).data("comentario");

                $("#editId").val(id);
                $("#editNome").val(nome);
                $("#editEmail").val(email);
                $("#editComentario").val(comentario);

                $("#editModal").modal("show");
            });

            <?php if ($mensagem): ?>
                Swal.fire({
                    icon: '<?php echo $mensagem['tipo']; ?>',
                    title: '<?php echo $mensagem['titulo']; ?>',
                    text: '<?php echo $mensagem['texto']; ?>'
                });
            <?php endif; ?>
        });
    </script>
    <script src="script/aprovar.js"></script>
    <script src="script/reprovar.js"></script>
    <script src="script/importarJSON.js"></script>
</body>
</html>
