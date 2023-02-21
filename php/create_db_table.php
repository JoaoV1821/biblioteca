<?php
require ("connection.php");

// ------------------------------------TABELA LOGIN----------------------------------------------------------//

    $conn = connect_db();

        $sql = "CREATE TABLE IF NOT EXISTS login (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(50) NOT NULL,
        senha VARCHAR(60) NOT NULL,
        nome VARCHAR(60) NOT NULL,
        cpf INT(11) NOT NULL
        )";

        if (mysqli_query($conn, $sql)) {
            echo "Credenciais de teste: Email -> teste@ufpr.br Senha -> teste";
        } 
        else {
            echo "Error creating table Lo: " . mysqli_error($conn);
        }

    disconnect_db($conn);

// ------------------------------------TABELA LIVRO----------------------------------------------------------//
    $conn = connect_db();

        $sql = "CREATE TABLE IF NOT EXISTS livro (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        titulo  VARCHAR(60) NOT NULL,
        autor   VARCHAR(60) NOT NULL,
        editora VARCHAR(60) NOT NULL,
        genero  VARCHAR(15) NOT NULL,
        imagem  VARCHAR(60) NOT NULL
        )";

        if (!mysqli_query($conn, $sql)) {
            echo "Error creating table Li: " . mysqli_error($conn);
        } 

    disconnect_db($conn);

// ------------------------------------TABELA ALUNO----------------------------------------------------------//

    $conn = connect_db();

        $sql = "CREATE TABLE IF NOT EXISTS aluno (
        id INT(6) UNSIGNED AUTO_INCREMENT UNIQUE KEY,
        nome VARCHAR(60) NOT NULL,
        email VARCHAR(50) NOT NULL,
        grr INT(8) NOT NULL PRIMARY KEY
        )";

        if (!mysqli_query($conn, $sql)) {
            echo "Error creating table Al: " . mysqli_error($conn);
        } 

    disconnect_db($conn);

// ------------------------------------TABELA EMPRESTIMO----------------------------------------------------------//

    $conn = connect_db();

        $sql = "CREATE TABLE IF NOT EXISTS emprestimo (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        id_livro INT(6) UNSIGNED NOT NULL,
        grr INT(8) NOT NULL,
        emp_data TIMESTAMP,
        dev_data DATE,
        CONSTRAINT fk_id_livro FOREIGN KEY (id_livro) REFERENCES livro(id),
        CONSTRAINT fk_grr FOREIGN KEY (grr) REFERENCES aluno(grr)
        )";

        if (!mysqli_query($conn, $sql)) {
            echo "Error creating table Em: " . mysqli_error($conn);
        } 

    disconnect_db($conn);

// ------------------------------------INSERT LIVRO----------------------------------------------------------//

    $conn = connect_db();

        $sql = "INSERT INTO livro (titulo,autor,editora,genero,imagem)
                SELECT * FROM (SELECT 'A Arte da Guerra', 'Sun Tzu','Moderna','Filosofia','../assets/imagens/guerra.jpeg') AS tmp
                WHERE NOT EXISTS (
                    SELECT titulo FROM livro WHERE titulo = 'A Arte da Guerra'
        ) LIMIT 1;
        ";

        if (!mysqli_query($conn, $sql)) {
            echo "Error inserting into Li: " . mysqli_error($conn);
        } 

    disconnect_db($conn);

// ------------------------------------INSERT LOGIN----------------------------------------------------------//

    $conn = connect_db();

        $senha = md5("teste");
        $sql = "INSERT INTO login (email,senha,nome,cpf)
                SELECT * FROM (SELECT 'teste@ufpr.br', '$senha','ADMINISTRADOR', 56711389069) AS tmp
                WHERE NOT EXISTS (
                    SELECT email FROM login WHERE email = 'teste@ufpr.br'
        ) LIMIT 1;
        ";

        if (!mysqli_query($conn, $sql)) {
            echo "Error inserting into Lo: " . mysqli_error($conn);
        } 

    disconnect_db($conn);

// ------------------------------------INSERT ALUNO----------------------------------------------------------//

    $conn = connect_db();

    $sql = "INSERT INTO aluno (nome,email,grr)
            SELECT * FROM (SELECT 'Andre Alex Jankoski', 'andre.alex@ufpr.br',20220048) AS tmp
            WHERE NOT EXISTS (
                SELECT email FROM aluno WHERE email = 'andre.alex@ufpr.br'
    ) LIMIT 1;
    ";

    if (!mysqli_query($conn, $sql)) {
        echo "Error inserting into Al: " . mysqli_error($conn);
    } 

    disconnect_db($conn);

// ------------------------------------INSERT EMPRESTIMO----------------------------------------------------------//

    $conn = connect_db();

    $sql = "INSERT INTO emprestimo (id_livro,grr,dev_data)
            SELECT * FROM (SELECT '1',20220048,'2023-03-11') AS tmp
            WHERE NOT EXISTS (
                SELECT grr FROM emprestimo WHERE grr = '20220048'
    ) LIMIT 1;
    ";

    if (!mysqli_query($conn, $sql)) {
        echo "Error inserting into Em: " . mysqli_error($conn);
    } 

    disconnect_db($conn);

?>