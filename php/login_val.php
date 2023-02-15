<?php 
require_once ("credentials.php");

//----------------------------------VALIDA CAMPOS---------------------------------------------------------//
    $erro = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
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
         // $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT); --> opcao de seguranca nao implementada (dificultaria os testes :D)
            $senha = ($_POST["senha"]);
          }
    }

$ntry = 1;
    // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT email,senha FROM login";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
        // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $creds = $row["email"] . $row["senha"];               // creds -> credenciais do banco de dados
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $creds_http = $email . $senha;                // credes_http -> credenciais recebidas pelo form
                         if ($creds == $creds_http){ 
                            $ntry++;                                  // n de tentativas (apenas para teste, pode ser retirada)
                            echo "no try: " . $ntry . "/";
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
            }
            else {
                echo "0 results";
            }

        mysqli_close($conn); 

?>