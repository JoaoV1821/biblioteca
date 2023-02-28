<?php 
require ("php/login_val.php"); 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/login.css">
    <title>Login</title>
</head>
<body>
    <main class="container">

        <fieldset class="form-container">
            <img src="./assets/icons/icons8-user-circle-96.png" alt="">
            <h1>Iniciar sessão</h1>
                <?php if(!empty($erro_val) || !empty($erro_email) || !empty($erro_senha)): ?>
                    <span id="error" class="erro"> <?php echo $erro_val; echo $erro_email; echo $erro_senha;?></span>
                <?php endif; ?>
                <span id="error" class="erro"></span>
            <form action="index.php" id="form" class="form" method="POST">
                    <input type="email" class="input" placeholder="Email" id="email" name="email" value="<?php echo $email?>">
                    <div class="line"></div>
                    <input type="password" class="input" placeholder="Senha" id="senha" name="senha" value="">
                    <div class="line"></div>

                <button type="submit" class="submit" id="submit">Entrar</button>
            </form>
        </fieldset>
        
    </main>
    <script src="../js/login.js"></script>
</body>
</html>