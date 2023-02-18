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
            <p class="link-nav"><a href="cadLivro.php">Cadastrar livro</a></p>
            <p class="link-nav"><a href="#">Cadastrar funcionário</a></p>
            <p class="link-nav"><a href="emprestimo.php">Empréstimo</a></p>
        </nav>
    </header>

    <main>
        
        <section class="container">
            <h1 class="title">Novo funcionário</h1>
            <form action="cadFunc.php" id="form" class="form" method="POST">
                <input name='nome' type="text" class="input" placeholder="Nome completo" id="nome" value="<?php echo $_POST['nome']?>">

                <div class="line"></div>
                <input name='email'type="email" class="input" placeholder="Email corporativo" id="email" value="<?php echo $_POST['email']?>">

                <div class="line"></div>
                <input name='cpf' type="text" class="input" placeholder="CPF" id="cpf" value="<?php echo $_POST['cpf']?>">

                <div class="line"></div>
                <input name='senha' type="password" class="input" placeholder="Senha" id="senha" value="<?php echo $_POST['senha']?>">

                <div class="line"></div>
                <input name='confSenha'type="password" class="input" placeholder="Confirme sua senha" id="confSenha" value="<?php echo $_POST['confSenha']?>">

                <div class="line"></div>
     
                <button type="submit" class="submit" id="submit">Cadastrar</button>
            </form>
        </section>
       
    </main>
    <script src="../js/cadFunc.js"></script>
</body>
</html>