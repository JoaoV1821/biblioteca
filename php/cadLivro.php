<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cadLivro.css">
    <title>Cadastro livro</title>
</head>
<body>

    <header class="header">
        <h1>WebLibrary</h1>
        <nav class="nav-bar">
            <p class="link-nav"><a href="dashboard.php">Inicio</a></p>
            <p class="link-nav"><a href="livros.php">Livros</a></p>
            <p class="link-nav"><a href="#">Cadastrar livro</a></p>
            <p class="link-nav"><a href="cadFuncionario.php">Cadastrar funcionário</a></p>
            <p class="link-nav"><a href="emprestimo.php">Empréstimo</a></p>
        </nav>
    </header>

    <main>
        
        <section class="container">
            <h1 class="title">Novo livro</h1>
            <form action="cadLivro.php" id="form" class="form" method="POST">
                <input type="text" class="input" placeholder="Titulo" id="titulo" value="<?php echo $_POST['titulo']?>">

                <div class="line"></div>
                <input type="text" class="input" placeholder="Autor" id="autor" value="<?php echo $_POST['autor']?>">

                <div class="line"></div>
                <input type="text" class="input" placeholder="Editora" id="editora" value="<?php echo $_POST['editora']?>">

                <div class="line"></div>
                <input type="text" class="input" placeholder="Gênero" id="genero" value="<?php echo $_POST['genero']?>">

                <div class="line"></div>
                
                <label for="imagem">Upload Imagem</label>
                <input type="file" class="input" placeholder="Imagem" id="imagem" value="<?php echo $_POST['imagem']?>">
                <div class="line"></div>
                    
                <button type="submit" class="submit" id="submit">Cadastrar</button>
            </form>
        </section>
       
    </main>
</body>
</html>