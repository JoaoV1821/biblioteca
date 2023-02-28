<?php 
    require("../php/authenticate.php");
    require("../php/connection.php");
    if (!$login){header("Location: /biblioteca-php/index.php");}

    $conn = connect_db();

    $sql = "SELECT * FROM emprestimo";
    $emprestimos = mysqli_query($conn,$sql);
    if(!$emprestimos){
        die('Problema ao carregar livros: '. mysqli_error($conn));
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/emprestimo.css">
    <title>Emprestimos</title>
</head>
<body class="root">
    <header class="header">
        <h1>WebLibrary</h1>
        <nav class="nav-bar">
            <p class="link-nav"><a href="dashboard.php">Inicio</a></p>
            <p class="link-nav"><a href="livros.php">Livros</a></p>
            <p class="link-nav"><a href="#">Empréstimos</a></p>
            <p class="link-nav"><a href="cadLivro.php">Novo livro</a></p>
            <p class="link-nav"><a href="cadFunc.php">Novo funcionário</a></p>
            <p class="link-nav"><a href="cadAlunos.php">Novo aluno</a></p>
            <p class="link-nav"><a href="cadEmp.php">Novo empréstimo</a></p>
            <p><a href="../php/logout.php"><img src="../assets/icons/icons8-shutdown-30.png" alt=""></a></p>
        </nav>
    </header>

    <main class="container">
        <h1 class="title">Empréstimos</h1>
        <table>
            <tr class="row">
                <th>Livro</th>
                <th>Aluno</th>
                <th>Grr</th>
                <th>Devolução</th>
                <th>Empréstimo</th>
            </tr>
            <?php if(mysqli_num_rows($emprestimos) > 0): ?>
                <?php while($emprestimo = mysqli_fetch_assoc($emprestimos)): ?>
                    <?php   
                            $id_livro = $emprestimo["id_livro"];
                            $sql = "SELECT titulo FROM livro where id = '$id_livro'";
                            $results_livro = mysqli_query($conn,$sql);
                            
                            $grr = $emprestimo["grr"];
                            $sql = "SELECT nome FROM aluno where grr = '$grr'";
                            $results_aluno = mysqli_query($conn,$sql);
                            
                    ?>
            <?php while($result_livro = mysqli_fetch_assoc($results_livro) ): ?>
                <?php  while( $result_aluno = mysqli_fetch_assoc($results_aluno) ): ?>
            <tr>
                <td><?= $result_livro["titulo"]?></td>
                <td><?= $result_aluno["nome"]?></td>
                <td><?= $emprestimo["grr"]?></td>
                <td><?= $emprestimo["dev_data"]?></td>
                <td><?= $emprestimo["emp_data"]?></td>
            </tr>
            <?php endwhile; ?>
            <?php endwhile; ?>
            <?php endwhile; ?>
            <?php else: ?>
                Nenhum empréstimo ativo.
            <?php endif; disconnect_db($conn); ?>
        </table>
    </main>
</body>
</html>