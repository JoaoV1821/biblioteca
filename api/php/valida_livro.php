<?php 

    require("connection.php");

    //---------------------------INSERCAO DE DADOS DO LIVRO------------------------------------//

    $erro = "";
    $erro_img = "";
    $uploaded = false;

    if ($login && $_SERVER["REQUEST_METHOD"]=="POST") {

        $conn = connect_db();

        if(empty($_POST["titulo"]) || empty($_POST["autor"]) || empty($_POST["editora"]) || empty($_POST["genero"])){
            $erro = "Todos os campos são obrigatórios.";
        }
        
            $titulo  = mysqli_real_escape_string($conn,$_POST["titulo"]);
            $autor   = mysqli_real_escape_string($conn,$_POST["autor"]);
            $editora = mysqli_real_escape_string($conn,$_POST["editora"]);
            $genero  = mysqli_real_escape_string($conn,$_POST["genero"]);

            //VALIDA IMAGEM

                $target_dir = "../assets/imagens/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                if($imageFileType == "") {
                    $erro_img = "Imagem é obrigatória.";
                    $uploadOk = 0;
                }

            // Check if image file is a actual image or fake image

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

            // Check if file already exists

                if (file_exists($target_file)) {
                    $erro_img = "O arquivo já existe.";
                    $uploadOk = 0;
                } 

            // Check file size

                if ($_FILES["fileToUpload"]["size"] > 10000000) {
                    $erro_img =  "O arquivo excede 10MB.";
                    $uploadOk = 0;
                }

            // Allow certain file formats
            
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    $erro_img =  "Apenas arquivos JPG/JPEG e PNG são aceitos.";
                    $uploadOk = 0;
                } 

        if (empty($erro) && empty($erro_img)){
            $sql = "INSERT INTO livro (titulo,autor,editora,genero,imagem)
            VALUES ('$titulo','$autor','$editora','$genero','$target_file')";
    
            if (mysqli_query($conn, $sql) && $uploadOk) {
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file); 
                $uploaded = true;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
        
        disconnect_db($conn);  
    } 
  ?>