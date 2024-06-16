<?php
require_once '../sql/conexao.php';
require_once '../Class/Usuario.php';
require_once '../Class/Comentario.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    
    header("Location: ../login/");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../Administrativo/styles.css">
    <style>
        
    </style>
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
                <li title="about"><a href="../cadastro/" class="active about">about</a></li>
                <li title="archive"><a href="#" class="archive">archive</a></li>
                <li title="contact"><a href="#" class="contact">contact</a></li>
                <li title="logout"><a href="../login/logout.php" class="logout">logout</a></li>
            </ul>
            <ul class="menu-bar">
                <li><a href="#" class="menu-button">Menu</a></li>
                <li><a href="../Administrativo/">Home</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Editorial</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </nav>      
    </header>
    <main class="content">
        <div class="cont container mt-5">
            <h1 class="pb-md-5">Cadastro de Usuário</h1>
            <form action="cadastrar_usuario.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="confirmar_senha" class="form-label">Confirmar Senha</label>
                            <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" required>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-4 flex-column justify-content-center pt-md-4">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                    <button type="reset" class="btn btn-secondary">Limpar</button>
                </div>
            </form>
        </div>
    </main>

    <script>
        $(document).ready(function(){
            $(".menu-button").click(function(){
                $(".menu-bar").toggleClass("open");
                $(".content").toggleClass("menu-expanded");
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" 
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>
</html>