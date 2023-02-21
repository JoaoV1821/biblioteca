<?php 
    require("../php/authenticate.php");
    require("../php/connection.php");

    if (!$login){header("Location: /biblioteca-php/index.php");}

    //---------------------------INSERCAO DE DADOS DO EMPRESTIMO------------------------------------//

    $uploaded = false;
    $erro = "";

    if ($login && $_SERVER["REQUEST_METHOD"]=="POST") {
        $conn = connect_db();

        if(empty($_POST["livro"]) || empty($_POST["grr"]) || empty($_POST["data"])){
            $erro = "Todos os campos são obrigatórios.";
        }
        
        $livro = mysqli_real_escape_string($conn,$_POST["livro"]);
        $grr = mysqli_real_escape_string($conn,$_POST["grr"]);
        $data = mysqli_real_escape_string($conn,$_POST["data"]);

        $sql = "SELECT id FROM livro WHERE titulo = '$livro'";
        $results = mysqli_query($conn, $sql);
        if(mysqli_num_rows($results) > 0 ){
            $result = mysqli_fetch_assoc($results);
            $id_livro = $result["id"];
        }
        else {
            $erro = "Livro não encontrado";
        }
        
        $sql = "SELECT grr FROM aluno WHERE grr = '$grr'";
        $results = mysqli_query($conn, $sql);
        if(mysqli_num_rows($results) == 0 ){
            $erro = "Aluno não encontrado";
        }

        if (empty($erro)) {
            $sql = "INSERT INTO emprestimo (id_livro,grr,dev_data)
            VALUES ('$id_livro','$grr','$data')";

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/form.css">
    <title>Document</title>
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
            <p class="link-nav"><a href="cadAlunos.php">Novo Aluno</a></p>
            <p class="link-nav"><a href="#">Novo empréstimo</a></p> 
            <p><a href="../php/logout.php"><img src="../assets/icons/icons8-shutdown-30.png" alt=""></a></p>
        </nav>
    </header>

    <main>
        <section class="container">
            <h1 class="title">Novo Empréstimo</h1>
            <?php if($uploaded): ?>
                    <span> <?= "Sucesso!"; ?></span>
                <?php elseif(!empty($erro)): ?>
                    <span class="erro"> <?= $erro; ?></span>
                <?php endif; ?>
                <span id="error" class="erro"></span>
            <span id="error" class="erro"></span>
            <form action="cadEmp.php" id="form" class="form" method="POST">

                <input name='livro'type="text" class="input" placeholder="Nome do livro" id="livro" value="<?php if ($uploaded) {echo "";} else if ($_SERVER["REQUEST_METHOD"] == "POST"){echo $_POST['livro'];}?>">

                <div class="line"></div>
                <input name='grr' type="text" class="input" placeholder="GRR" id="grr" value="<?php if ($uploaded) {echo "";} else if ($_SERVER["REQUEST_METHOD"] == "POST"){echo $_POST['grr'];}?>">

                <div class="line"></div>
               
                <input name="data" type="date" class="input"  id="dataDev">
                <div class="line"></div>
                <button type="submit" class="submit" id="submit">Cadastrar</button>
            </form>
        </section>
    </main>
    <script src="../js/cadEmp.js"></script>
</body>
</html>