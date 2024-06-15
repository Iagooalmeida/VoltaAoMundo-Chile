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
            <h2 class="text-center fs-4">Bem-vindo, <?php echo explode(' ', $_SESSION['nomeCompleto'])[0]; ?></h2>
        </div>
        <nav>
            <ul class="menu">
                <li title="home"><a href="#" class="menu-button home">menu</a></li>
                <li title="search"><a href="#" class="search">search</a></li>
                <li title="pencil"><a href="#" class="pencil">pencil</a></li>
                <li title="about"><a href="#" class="active about">about</a></li>
                <li title="archive"><a href="#" class="archive">archive</a></li>
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
                    <?php foreach($comentarios as $comentario): ?>
                        <tr>
                            <td><?php echo $comentario['id']; ?></td>
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
                                <button class="btn btn-primary btn-edit" data-id="<?php echo $comentario['id']; ?>"title="Editar">
                                    <ion-icon name="create-outline"></ion-icon>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <form id="importForm" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="jsonFile" class="form-label">Importar Comentários via JSON</label>
                    <input class="form-control" type="file" id="jsonFile" name="jsonFile">
                </div>
                <button type="submit" class="btn btn-primary">Importar</button>
            </form>

            <!-- <form id="exportForm" method="POST">
                <button type="submit" class="btn btn-primary">Exportar</button>
            </form> -->
        </div>
    </main>
    <footer class="content">
        <!-- place footer here -->
    </footer>
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
        });
    </script>

    <script src="script/aprovar.js"></script>
    <script src="script/reprovar.js"></script>
</body>
</html>
