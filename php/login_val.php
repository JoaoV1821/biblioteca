<?php 
require ("authenticate.php");
require ("create_db_table.php");

//----------------------------------VALIDA CAMPOS---------------------------------------------------------//
    $email = "";
    $senha = "";
    $erro = false;

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
                $erro = true;
              }
          }

          if(empty($_POST["senha"])){
            $erro_senha = "Senha é obrigatória.";
            $erro = true;
          }
          else{
            $senha = $_POST["senha"];
            //$senha = md5($senha);
          }
    }

    if (!$login && $_SERVER["REQUEST_METHOD"] == "POST") {

        $ntry = 1;
        $conn = connect_db();
        
        $email = mysqli_real_escape_string($conn,$email);
        $senha = mysqli_real_escape_string($conn,$senha);

        $sql = "SELECT email,senha FROM login";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $creds = $row["email"] . $row["senha"];               // creds -> credenciais do banco de dados
                $creds_http = $email . $senha;                        // creds_http -> credenciais recebidas pelo form
                    if ($creds == $creds_http){ 
                        $ntry++;                                      // n de tentativas 
                        echo "no try: " . $ntry . "/";
                        $_SESSION["email"] = $row["email"];
                        header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "/dashboard.php");
                        break;
                    } 
                    else if ($ntry == mysqli_num_rows($result)){
                        $erro = true;
                        $erro_creds = "E-mail ou senha incorreto(s)";
                        echo $erro_creds;
                    }
                    else {
                        $ntry++;
                    }
            }
        }
        else {echo "0 results";}
        disconnect_db($conn);
    }
    if ($login){
        header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "/dashboard.php");  
    }
?>
