<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/reset.css">
    <title>Login</title>
</head>
<body>
    <main class="container">

        <fieldset class="form-container">
            <img src="../assets/icons8-user-circle-96.png" alt="">
            <h1>Iniciar sessão</h1>

            <form action="index.php" id="form" class="form" method="POST">
                    <input type="email" class="input" placeholder="Email" id="email" value="<?php echo $_POST['email']?>">
                    <div class="line"></div>
                    <input type="password" class="input" placeholder="Senha" id="senha" value="<?php echo $_POST['senha']?>">
                    <div class="line"></div>

                <button type="submit" class="submit" id="submit">Entrar</button>
            </form>
        </fieldset>
        
    </main>
    <script src="../js/login.js"></script>
</body>
</html>