<?php 

    require("connection.php");

    //---------------------------INSERCAO DE DADOS DO LIVRO------------------------------------//

    $erro = false;

    if ($login && $_SERVER["REQUEST_METHOD"]=="POST") {

        $conn = connect_db();
        
            $titulo = mysqli_real_escape_string($conn,$_POST["titulo"]);
            $autor = mysqli_real_escape_string($conn,$_POST["autor"]);
            $editora = mysqli_real_escape_string($conn,$_POST["editora"]);
            $genero = mysqli_real_escape_string($conn,$_POST["genero"]);

            //VALIDA IMAGEM

                $target_dir = "imagens/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                if($imageFileType == "") {
                    $erro_img = "Imagem é obrigatória.";
                    $erro = true;
                    $uploadOk = 0;
                return;
                }

            // Check if image file is a actual image or fake image

                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                        if($check !== false) {
                            $uploadOk = 1;
                        } 
                else {
                    $erro_img = "Arquivo não é uma imagem.";
                    $erro = true;
                    $uploadOk = 0;
                    }
                }

            // Check if file already exists

                if (file_exists($target_file)) {
                    $erro_img = "O arquivo já existe.";
                    $erro = true;
                    $uploadOk = 0;
                } 

            // Check file size

                if ($_FILES["fileToUpload"]["size"] > 1000000) {
                    $erro_img =  "O arquivo excede 1MB.";
                    $erro = true;
                    $uploadOk = 0;
                }

            // Allow certain file formats
            
                if($imageFileType != "jpg" && $imageFileType != "png") {
                    $erro_img =  "Apenas arquivos JPG e PNG são aceitos.";
                    $erro = true;
                    $uploadOk = 0;
                } 

            if ($erro==true) {return;} // Para imagem nao ser enviada em caso de erros em qualquer parte do formulario

            if ($uploadOk == 1) {
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file); 
            }

        $sql = "INSERT INTO livro
        VALUES ('$titulo','$autor','$editora','$genero','$target_file')";

        if (mysqli_query($conn, $sql)) {
            echo "/R Li Up";
            $uploaded = true;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        disconnect_db($conn);  
    } 
  ?>