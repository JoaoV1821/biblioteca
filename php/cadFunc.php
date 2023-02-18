<?php 

      require("authenticate.php");
      require("connection.php");

      if (!$login){header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "/index.php");}

      //---------------------------INSERCAO DE DADOS DO FUNCIONARIO------------------------------------//

      if ($login && $_SERVER["REQUEST_METHOD"]=="POST") {
        $conn = connect_db();
        
        $email = mysqli_real_escape_string($conn,$_POST["email"]);
        $senha = md5($_POST["senha"]);

        $sql = "INSERT INTO login (email, senha)
        VALUES ('". $email . "','" . $senha . "')";

        if (mysqli_query($conn, $sql)) {
            echo "/R Lo Up";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        disconnect_db($conn);  
    }        
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
            <p class="link-nav"><a href="cadLivro.php">Cadastrar livro</a></p>
            <p class="link-nav"><a href="#">Cadastrar funcionário</a></p>
            <p class="link-nav"><a href="emprestimo.php">Empréstimo</a></p>
        </nav>
    </header>

    <main>
        
        <section class="container">
            <h1 class="title">Novo funcionário</h1>
            <form action="cadFunc.php" id="form" class="form" method="POST">
                <input type="text" class="input" placeholder="Nome completo" name="nome" id="nome" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {echo $_POST['nome'];}?>">

                <div class="line"></div>
                <input type="email" class="input" placeholder="Email corporativo" name="email" id="email" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {echo $_POST['email'];}?>">
                <div class="line"></div>
                <input type="text" class="input" placeholder="CPF" name="cpf" id="cpf" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {echo $_POST['cpf'];}?>">

                <div class="line"></div>
                <input type="password" class="input" placeholder="Senha" name="senha" id="senha" value="">

                <div class="line"></div>
                <input type="password" class="input" placeholder="Confirme sua senha" name="confSenha" id="confSenha" value="">

                <div class="line"></div>
     
                <button type="submit" class="submit" id="submit">Cadastrar</button>
            </form>
        </section>
       
    </main>
</body>
</html>