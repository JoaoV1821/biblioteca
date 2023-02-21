<?php 
    require("../php/authenticate.php");
    require("../php/connection.php");
    if (!$login){header("Location: /biblioteca-php/index.php");}

    $conn = connect_db();

        if($_SERVER["REQUEST_METHOD"] == "GET"){
            if(isset($_GET["acao"])){
                if($_GET["acao"] == "del"){
                    $id = mysqli_real_escape_string($conn,$_GET["id"]);
                    $sql = "SELECT imagem FROM livro where id ='$id'";
                    $imagem = mysqli_query($conn, $sql);
                    $imagens = mysqli_fetch_assoc($imagem);
                    $path = $imagens['imagem'];                         // Procura e salva o caminho do arquivo na tabela

                    $sql = "DELETE FROM livro where id = '" . $_GET["id"] . "'";
                    if(!mysqli_query($conn, $sql)){
                        die('Problema ao remover livro: '. mysqli_error($conn));
                    } 
                    else {
                        unlink($path);                                  // Deleta arquivo salvo 
                    }  
                }
            }
        }
        
        $sql = "SELECT * FROM livro";
        $livros = mysqli_query($conn,$sql);
        if(!$livros){
            die('Problema ao carregar livros: '. mysqli_error($conn));
        }

        if($_SERVER["REQUEST_METHOD"] == "GET"){
            if(isset($_GET["fil"])){
                $filtro = mysqli_real_escape_string($conn,$_GET["fil"]);
                $sql = "SELECT * FROM livro WHERE genero ='$filtro'";
                $livros = mysqli_query($conn, $sql);

                if(!$livros){
                    die('Problema ao aplicar filtros: '. mysqli_error($conn));
                }  
            }
        }
    disconnect_db($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/livros.css">
    <title>Livros</title>
</head>
<body class="root">
    <header class="header">
        <h1>WebLibrary</h1>
        <nav class="nav-bar">
            <p class="link-nav"><a href="dashboard.php">Inicio</a></p>
            <p class="link-nav"><a href="livros.php">Livros</a></p>
            <p class="link-nav"><a href="emprestimo.php">Empréstimos</a></p>
            <p class="link-nav"><a href="cadLivro.php">Novo livro</a></p>
            <p class="link-nav"><a href="cadFunc.php">Novo funcionário</a></p>
            <p class="link-nav"><a href="cadAlunos.php">Novo aluno</a></p>
            <p class="link-nav"><a href="cadEmp.php">Novo empréstimo</a></p>
            <p><a href="../php/logout.php"><img src="../assets/icons/icons8-shutdown-30.png" alt=""></a></p>
        </nav>
    </header>

    <main class="container">
        <nav class="options">
            <p class="link-nav"><a href="livros.php">Todos</a></p>
            <p class="link-nav"><a href="livros.php?fil=filosofia">Filosofia</a></p>
            <p class="link-nav"><a href="livros.php?fil=ficcao">Ficção Científica</a></p>
            <p class="link-nav"><a href="livros.php?fil=psicologia">Psicologia</a></p>
            <p class="link-nav"><a href="livros.php?fil=classicos">Clássicos</a></p>
            <p class="link-nav"><a href="livros.php?fil=aventura">Aventura</a></p>
        </nav>

        <section class="grid-books">

            <?php if(mysqli_num_rows($livros) > 0): ?>
                <?php while($livro = mysqli_fetch_assoc($livros)): ?>
                <div class="book">
                <section class="img-book" >
                    <img src="<?=$livro['imagem']?>" alt="">
                </section>

                <section class="info-book">
                    <h2><?=$livro['titulo']?></h2> 
                    <h4><?=$livro['autor']?></h4>
                    <h5><?=$livro['genero']?></h5>
                    <button class="btn"><a href="alterLivro.php?id=<?= $livro['id']?>">Editar</a></button>
                    <button class="btn" onclick="confirm('Deseja deletar este livro?')"><a href="<?= $_SERVER["PHP_SELF"]?>?acao=del&id=<?= $livro['id']?>">Remover</a></button>
                </section>
                </div>
                <?php endwhile; ?>
                <?php else: ?>
                    Nenhum livro encontrado.
                <?php endif; ?>
        </section>
    </main>
</body>
</html>