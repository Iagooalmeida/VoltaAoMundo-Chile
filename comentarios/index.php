<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <div class="d-flex justify-content-end align-items-center gap-3 bg-chile p-2 pe-md-5">
            <a href="https://www.linkedin.com/in/iago-de-oliveira-almeida-a342a01a4/" 
                rel="noopener noreferrer" title="Linkedin" target="_blank">
                <ion-icon name="logo-linkedin" class="large mr-3"></ion-icon>
            </a>
            <a href="https://github.com/Iagooalmeida/VoltaAoMundo-Chile" 
                rel="noopener noreferrer" title="repositorio github" target="_blank">
                <ion-icon name="logo-github" class="large mr-3"></ion-icon>
            </a>
            <a href="../login/" class="check-in btn btn-primary">Login</a>
        </div>
    </header>
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="../img/Logo Chile.jpeg" class="logo" alt="Volta ao Mundo">
            </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="../index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../sobre-chile.html">Sobre o Chile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../gastronomia-chile.html">Gastronomia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pontos-turisticos.html">Pontos Turísticos</a>
                </li>
                <li>
                    <a class="nav-link" href="../galeria-chile.html">Galeria</a>
                </li>
                <li>
                    <a class="nav-link" href="#">Comentários</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="col-12">
            <div class="position-relative">
                <img src="../img/banner/Banner-com-bandeira-do-chile.jpg" class="img-fluid w-100" alt="Imagem">
                <div class="position-absolute top-50 start-50 translate-middle text-center">
                    <h2 class="text-white">Comentário</h2>
                </div>
            </div>
        </div>
    </div>

    <main class="comment">
        <div class="container mt-5">
            <h1 class="text-chile text-center">Envie um comentário</h1>
            <form action="gravarComentario.php" method="POST">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome<span class="text-chile">*</span></label>
                    <input type="text" class="form-control" id="nome" name="nome" autofocus placeholder="Digite seu nome aqui ..." required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail<span class="text-chile">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite um email valido ..." required>
                    <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>
                </div>
                <div class="mb-3">
                    <label for="comentario" class="form-label">Comentário<span class="text-chile">*</span></label>
                    <textarea class="form-control" id="comentario" name="comentario" rows="5"  required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Enviar</button>
            </form>
            <hr>
        </div>
        <h2 class="text-chile text-center mt-5">Comentários de Visitantes</h2>
        <div class="container pb-5">
            <div class="row">
            <?php
            require_once '../sql/Conexao.php';
            require_once '../Class/Comentario.php';
            $comentario = new Comentario($conn);
            $comentarios = $comentario->listarComentarios();

            // Display approved comments
            foreach ($comentarios as $comentario) {
                if ($comentario['status'] == 'Aprovado') {
                echo '<div class="col-md-6">';
                echo '<div class="card mb-3">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $comentario['nome'] . '</h5>';
                echo '<h6 class="card-subtitle mb-2 text-muted">' . $comentario['email'] . '</h6>';
                echo '<p class="card-text">' . $comentario['comentario'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                }
            }
            ?>
            </div>
        </div>
    </main>
    
    <!-- rodapé -->
    <footer class="bg-chile text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Sobre</h5>
                    <p>Coloque aqui uma breve descrição sobre o seu site ou empresa.</p>
                </div>
                <div class="col-md-4">
                    <h5>Links Úteis</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.html">Página Inicial</a></li>
                        <li><a href="sobre-chile.html">Sobre Chile</a></li>
                        <li><a href="gastronomia-chile.html">Gastronomia</a></li>
                        <li><a href="galeria-chile.html">Galeria</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contato</h5>
                    <p>Endereço: Av. Exemplo, 123 - Cidade, Estado</p>
                    <p>Email: exemplo@example.com</p>
                    <p>Telefone: (00) 1234-5678</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>&copy; 2024 Fatec Itapira - Copyright</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- conexão bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous">
    </script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous">
    </script>
</body>
</html>