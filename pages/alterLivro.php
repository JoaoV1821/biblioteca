<?php 
    require("../php/authenticate.php");
    require("../php/connection.php");

    if (!$login){header("Location: /biblioteca-php/index.php");} 
    
    $conn = connect_db();

        if($_SERVER["REQUEST_METHOD"] == "GET"){
            if(isset($_GET["id"])){
                $id = mysqli_real_escape_string($conn,$_GET["id"]);
                $_SESSION["id"] = $id;
                $sql = "SELECT * FROM livro where id = '$id'";
                $livros = mysqli_query($conn,$sql);
                if(!$livros){
                    die('Problema ao encontrar o livro: '. mysqli_error($conn));
                }
            }      
        }

    disconnect_db($conn);  

    //---------------------------UPDATE DE DADOS DO LIVRO------------------------------------//

    $erro = "";
    $erro_img = "";
    $uploaded = false;

    if ($login && $_SERVER["REQUEST_METHOD"]=="POST") {

        $conn = connect_db();

            if(empty($_POST["titulo"]) || empty($_POST["autor"]) || empty($_POST["editora"]) || empty($_POST["genero"])){
                $erro = "Todos os campos são obrigatórios.";
            }

            $id = $_SESSION["id"];

            $sql = "SELECT imagem FROM livro where id ='$id'";
            $imagem = mysqli_query($conn, $sql);
            $imagens = mysqli_fetch_assoc($imagem);
            $path = $imagens['imagem'];
        
            $titulo  = mysqli_real_escape_string($conn,$_POST["titulo"]);
            $autor   = mysqli_real_escape_string($conn,$_POST["autor"]);
            $editora = mysqli_real_escape_string($conn,$_POST["editora"]);
            $genero  = mysqli_real_escape_string($conn,$_POST["genero"]);

            $target_dir = "../assets/imagens/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                if($imageFileType == "") {
                    $erro_img = "Imagem é obrigatória.";
                    $uploadOk = 0;
                }

                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                        if($check !== false) {
                            $uploadOk = 1;
                        }
                        else {
                            $erro_img = "Arquivo não é uma imagem.";
                            $uploadOk = 0;
                        }
                }
                
                if ($_FILES["fileToUpload"]["size"] > 10000000) {
                    $erro_img =  "O arquivo excede 10MB.";
                    $uploadOk = 0;
                }
            
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    $erro_img =  "Apenas arquivos JPG/JPEG e PNG são aceitos.";
                    $uploadOk = 0;
                } 


            if (empty($erro) && empty($erro_img)){
                $sql = "UPDATE livro 
                        SET titulo = '$titulo',
                            autor = '$autor',
                            editora = '$editora',
                            genero = '$genero',
                            imagem = '$target_file'
                        WHERE id = '$id'";
                $update = mysqli_query($conn, $sql);
                if ($update) {
                    if ($uploadOk) {
                        unlink($path);
                        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file); 
                        $uploaded = true;
                    } 
                } else {
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
    <title>Altera livro</title>
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
            <p class="link-nav"><a href="cadAluno.php">Novo aluno</a></p>
            <p class="link-nav"><a href="cadEmp.php">Novo empréstimo</a></p>
            <p><a href="../php/logout.php"><img src="../assets/icons/icons8-shutdown-30.png" alt=""></a></p>
        </nav>
    </header>

    <main>
    <section class="container">
            <h1 class="title">Alterar Livro</h1>
            <?php if($uploaded): ?>
                    <span> <?= "Sucesso!"; ?></span>
            <?php elseif(!empty($erro) || !empty($erro_img)): ?>
                    <span id="error" class="erro"> <?php echo $erro, $erro_img; ?></span>
            <?php endif; ?>
            <span id="error" class="erro"></span>
            <?php if(isset($_GET["id"])) {$livro = mysqli_fetch_assoc($livros);} 
                  else {echo "Selecione um livro para editar na página Livros!";}
            ?>
            <form enctype="multipart/form-data" action="alterLivro.php" id="form" class="form" method="POST">
                <input name ='titulo' type="text" class="input" placeholder="Titulo" id="titulo" value="<?php if(isset($_GET["id"])) {echo $livro["titulo"];}?>">

                <div class="line"></div>
                <input name='autor'type="text" class="input" placeholder="Autor" id="autor" value="<?php if(isset($_GET["id"])) {echo $livro["autor"];}?>">

                <div class="line"></div>
                <input name='editora' type="text" class="input" placeholder="Editora" id="editora" value="<?php if(isset($_GET["id"])) {echo $livro["editora"];}?>">

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
                <input name='fileToUpload' type="file" class="input" placeholder="Imagem" id="imagem" value="">
                <div class="line"></div>
                    
                <button type="submit" class="submit" id="submit">Alterar</button>
            </form>
        </section>
       
    </main>
    <script src="../js/cadLivro.js"></script>
</body>

</html>