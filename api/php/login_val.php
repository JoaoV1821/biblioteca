<?php 
require ("authenticate.php");
require ("create_db_table.php");

//----------------------------------VALIDA CAMPOS---------------------------------------------------------//
    $email = "";
    $senha = "";
    $erro_email = $erro_senha = "";

    if (!$login && $_SERVER["REQUEST_METHOD"] == "POST") {
    
        if(empty($_POST["email"])){
            $erro_email = "Email é obrigatório.";
            $erro = true;
          }
          else{
              $email = $_POST["email"];
              $email = filter_var($email, FILTER_SANITIZE_EMAIL);
              if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $erro_email = " Endereço de e-mail inválido.";
              }
          }

          if(empty($_POST["senha"])){
            $erro_senha = "Senha é obrigatória.";
          }
          else{
            $senha = md5($_POST["senha"]);
          }
    }

    if (!$login && $_SERVER["REQUEST_METHOD"] == "POST") {

        $conn = connect_db();
        
            $email = mysqli_real_escape_string($conn,$email);
            $senha = mysqli_real_escape_string($conn,$senha);

            $sql = "SELECT email,senha FROM login WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                    if ($row['senha'] == $senha){
                        $_SESSION["email"] = $row["email"];
                        header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "/pages/dashboard.php");
                    } 
                    else {
                        $erro_val = "Email ou senha incorreto(s)";
                    }                                                                   
            }                        
            else {
                $erro_val = "Email ou senha incorreto(s)";
            }
        disconnect_db($conn);
    }
    if ($login){ 
        header("Location: /biblioteca-php/pages/dashboard.php");  
    }
?>
