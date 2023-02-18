<?php 
      require("authenticate.php");
      require("valida_livro.php");

      if (!$login){header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "/index.php");}       
?>

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
            <p class="link-nav"><a href="cadFunc.php">Cadastrar funcionário</a></p>
            <p class="link-nav"><a href="emprestimo.php">Empréstimo</a></p>
        </nav>
    </header>

    <main>
        
        <section class="container">
            <h1 class="title">Novo livro</h1>
            <form enctype="multipart/form-data" action="cadLivro.php" id="form" class="form" method="POST">
                <input type="text" class="input" placeholder="Titulo" name="titulo" id="titulo" value="
                    <?php if ($uploaded) {echo ""} else if ($_SERVER["REQUEST_METHOD"] == "POST" && !$uploaded){echo $_POST['titulo'];}?>
                ">

                <div class="line"></div>
                <input type="text" class="input" placeholder="Autor" name="autor" id="autor" value="
                    <?php if ($uploaded) {echo ""} else if ($_SERVER["REQUEST_METHOD"] == "POST" && !$uploaded){echo $_POST['autor'];}?>
                ">

                <div class="line"></div>
                <input type="text" class="input" placeholder="Editora" name="editora" id="editora" value="
                    <?php if ($uploaded) {echo ""} else if ($_SERVER["REQUEST_METHOD"] == "POST" && !$uploaded){echo $_POST['editora'];}?>
                ">

                <div class="line"></div>
                <input type="text" class="input" placeholder="Gênero" name="genero" id="genero" value="
                    <?php if ($uploaded) {echo ""} else if ($_SERVER["REQUEST_METHOD"] == "POST" && !$uploaded){echo $_POST['genero'];}?>
                ">

                <div class="line"></div>
                
                <label for="imagem">Upload Imagem</label>
                <input type="file" class="input" placeholder="Imagem" name="fileToUpload" id="imagem" value=""> 
                <div class="line"></div>
                    
                <button type="submit" class="submit" id="submit">Cadastrar</button>
            </form>
        </section>
       
    </main>
</body>
</html>