<?php 
      require("../php/authenticate.php");
      require("../php/valida_livro.php");

      if (!$login){header("Location: /biblioteca-php/index.php");}       
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/form.css">
    <title>Cadastro livro</title>
</head>
<body class="root">

    <header class="header">
        <h1>WebLibrary</h1>
        <nav class="nav-bar">
            <p class="link-nav"><a href="dashboard.php">Inicio</a></p>
            <p class="link-nav"><a href="livros.php">Livros</a></p>
            <p class="link-nav"><a href="emprestimo.php">Empréstimos</a></p>
            <p class="link-nav"><a href="#">Novo livro</a></p>
            <p class="link-nav"><a href="cadFunc.php">Novo funcionário</a></p>
            <p class="link-nav"><a href="cadAlunos.php">Novo aluno</a></p>
            <p class="link-nav"><a href="cadEmp.php">Novo empréstimo</a></p>
            <p><a href="../php/logout.php"><img src="../assets/icons/icons8-shutdown-30.png" alt=""></a></p>
        </nav>
    </header>

    <main>
        
        <section class="container">
            <h1 class="title">Novo livro</h1>
                <?php if($uploaded): ?>
                    <span> <?= "Sucesso!"; ?></span>
                <?php elseif(!empty($erro) || !empty($erro_img)): ?>
                    <span id="error" class="erro"> <?php echo $erro, $erro_img; ?></span>
                <?php endif; ?>
                <span id="error" class="erro"></span>
            <form enctype="multipart/form-data" action="cadLivro.php" id="form" class="form" method="POST">
                <input type="text" class="input" placeholder="Titulo" name="titulo" id="titulo" value="<?php if ($uploaded) {echo "";} elseif ($_SERVER["REQUEST_METHOD"] == "POST"){echo $_POST['titulo'];}?>">

                <div class="line"></div>
                <input type="text" class="input" placeholder="Autor" name="autor" id="autor" value="<?php if ($uploaded) {echo "";} elseif ($_SERVER["REQUEST_METHOD"] == "POST"){echo $_POST['autor'];}?>">

                <div class="line"></div>
                <input type="text" class="input" placeholder="Editora" name="editora" id="editora" value="<?php if ($uploaded) {echo "";} elseif ($_SERVER["REQUEST_METHOD"] == "POST"){echo $_POST['editora'];}?>">

                <div class="line"></div>
                <section class="input-livros">
                    <input type="text" class="input input-genero" placeholder="Gênero" id="genero" value="" readonly>
                    <select name="genero" id="livros">
                        <option value="filosofia">Filosofia</option>
                        <option value="aventura">Aventura</option>
                        <option value="ficcao">Ficção Científica</option>
                        <option value="psicologia">Psicologia</option>
                        <option value="classicos">Clássicos</option>
                    </select>
                </section>

                <div class="line"></div>
                
                <label for="imagem">Upload Imagem</label>
                <input type="file" class="input" placeholder="Imagem" name="fileToUpload" id="imagem" value=""> 
                <div class="line"></div>
                    
                <button type="submit" class="submit" id="submit">Cadastrar</button>
            </form>
        </section>
       
    </main>
    <script src="../js/cadLivro.js"></script>
</body>
</html>