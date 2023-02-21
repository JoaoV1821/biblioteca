<?php 
    require ("../php/authenticate.php");
    require ("../php/connection.php");
    if (!$login){header("Location: /biblioteca-php/index.php");}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    

    <title>Dashboard</title>
</head>
<body class="root">
    <header class="header">
        <h1>WebLibrary</h1>
        <nav class="nav-bar">
            <p class="link-nav"><a href="#">Inicio</a></p>
            <p class="link-nav"><a href="livros.php">Livros</a></p>
            <p class="link-nav"><a href="emprestimo.php">Empréstimos</a></p>
            <p class="link-nav"><a href="cadLivro.php">Novo livro</a></p>
            <p class="link-nav"><a href="cadFunc.php">Novo funcionário</a></p>
            <p class="link-nav"><a href="cadAlunos.php">Novo aluno</a></p>
            <p class="link-nav"><a href="cadEmp.php">Novo empréstimo</a></p>
            <p><a href="../php/logout.php"><img src="../assets/icons/icons8-shutdown-30.png" alt=""></a></p>
        </nav>
    </header>

    <main>
        <h1 class="title">Dashboard</h1>
        <section class="container">
        <div class="card">
           <section>
            <img src="../assets/icons/icons8-system-administrator-male-64 (1).png" alt="">
           </section>
            <h1>Administradores</h1>

            <h2 class="number-card">
                <?php 
                    $conn = connect_db(); 
                    $sql = "SELECT COUNT(email) AS TOTAL FROM login ";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    echo $row['TOTAL'];
                ?>
            </h2>
        </div>

        <div class="card">
            <section>
                <img src="../assets/icons/icons8-open-book-64 (1).png" alt="">
            </section>
            <h1>Livros</h1>
            <h2 class="number-card">
                <?php
                    $sql = "SELECT COUNT(titulo) AS TOTAL FROM livro ";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    echo $row['TOTAL'];
                ?>
            </h2>
        </div>

        <div class="card">
            <section>
                <img src="../assets/icons/icons8-category-64 (1).png" alt="">
            </section>
            <h1>Categorias</h1>
            <h2 class="number-card">5</h2>
        </div>

        <div class="card">
            <section>
                <img src="../assets/icons/icons8-student-64 (1).png" alt="">
            </section>
            <h1>Alunos</h1>
            <h2 class="number-card">
                <?php
                    $sql = "SELECT COUNT(nome) AS TOTAL FROM aluno ";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    echo $row['TOTAL'];
                    disconnect_db($conn);
                ?>
            </h2>
        </div>
        </section>

    </main>
</body>
</html>