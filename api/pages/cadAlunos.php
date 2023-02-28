<?php 
    require("../php/authenticate.php");
    require("../php/connection.php");

    if (!$login){header("Location: /biblioteca-php/index.php");}

    //---------------------------INSERCAO DE DADOS DO FUNCIONARIO------------------------------------//

    $uploaded = false;
    $erro = "";

    if ($login && $_SERVER["REQUEST_METHOD"]=="POST") {
        $conn = connect_db();

        if(empty($_POST["nome"]) || empty($_POST["email"]) || empty($_POST["grr"])){
            $erro = "Todos os campos são obrigatórios.";
        }
        
        $nome = mysqli_real_escape_string($conn,$_POST["nome"]);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $erro = " Endereço de e-mail inválido.";
        }
        else {
            $email = mysqli_real_escape_string($conn,$email);
        }
        $grr = mysqli_real_escape_string($conn,$_POST["grr"]);

        if (empty($erro)) {
            $sql = "INSERT INTO aluno (nome,email,grr)
            VALUES ('$nome','$email','$grr')";

            if (mysqli_query($conn, $sql)) {
                $uploaded = true;
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
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
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/form.css">
    <title>Dashboard</title>
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
            <p class="link-nav"><a href="#">Novo aluno</a></p>
            <p class="link-nav"><a href="cadEmp.php">Novo empréstimo</a></p>
            <p><a href="../php/logout.php"><img src="../assets/icons/icons8-shutdown-30.png" alt=""></a></p>
        </nav>
    </header>

    <main>
    <section class="container">
            <h1 class="title">Novo Aluno</h1>
                <?php if($uploaded): ?>
                    <span> <?= "Sucesso!"; ?></span>
                <?php elseif(!empty($erro)): ?>
                    <span class="erro"> <?= $erro; ?></span>
                <?php endif; ?>
                <span id="error" class="erro"></span>
            <form action="cadAlunos.php" id="form" class="form" method="POST">
                <input name='nome' type="text" class="input" placeholder="Nome completo" id="nome" value="<?php if ($uploaded) {echo "";} else if ($_SERVER["REQUEST_METHOD"] == "POST"){echo $_POST['nome'];}?>">

                <div class="line"></div>
                <input name='email'type="email" class="input" placeholder="Email corporativo" id="email" value="<?php if ($uploaded) {echo "";} else if ($_SERVER["REQUEST_METHOD"] == "POST"){echo $_POST['email'];}?>">

                <div class="line"></div>
                <input name='grr' type="text" class="input" placeholder="GRR" id="grr" value="<?php if ($uploaded) {echo "";} else if ($_SERVER["REQUEST_METHOD"] == "POST"){echo $_POST['grr'];}?>">

                <div class="line"></div>
     
                <button type="submit" class="submit" id="submit">Cadastrar</button>
            </form>
        </section>
    </main>
    <script src="../js/cadAluno.js"></script>
<body>