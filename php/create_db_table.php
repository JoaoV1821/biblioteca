<?php
require ("connection.php");

    $conn = connect_db();

    // Create database
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        if (mysqli_query($conn, $sql)) {
            echo " DB Up ";
        } 
        else {
            echo "Error creating database: " . mysqli_error($conn);
        }

    disconnect_db($conn);

// ------------------------------------TABELA LOGIN----------------------------------------------------------//


    $conn = connect_db();

        $sql = "CREATE TABLE IF NOT EXISTS login (
        email VARCHAR(50) NOT NULL,
        senha VARCHAR(60) NOT NULL,
        PRIMARY KEY (email)
        )";

        if (mysqli_query($conn, $sql)) {
            echo "/ Tb Lo Up ";
            echo "/ Credenciais de teste: email -> teste@teste.com senha -> teste";
        } 
        else {
            echo "Error creating table Lo: " . mysqli_error($conn);
        }

    disconnect_db($conn);

// ------------------------------------TABELA LIVRO----------------------------------------------------------//
    $conn = connect_db();

        $sql = "CREATE TABLE IF NOT EXISTS livro (
        titulo  VARCHAR(60) NOT NULL,
        autor   VARCHAR(60) NOT NULL,
        editora VARCHAR(60) NOT NULL,
        genero  VARCHAR(15) NOT NULL,
        imagem  VARCHAR(60) NOT NULL,
        PRIMARY KEY (titulo)
        )";

        if (mysqli_query($conn, $sql)) {
            echo "/ Tb Li Up ";
        } 
        else {
            echo "Error creating table Li: " . mysqli_error($conn);
        }

    disconnect_db($conn);

// ------------------------------------TABELA ALUNO----------------------------------------------------------//

    $conn = connect_db();

        $sql = "CREATE TABLE IF NOT EXISTS aluno (
        nome VARCHAR(60) NOT NULL,
        email VARCHAR(50) NOT NULL,
        grr INT(8) NOT NULL
        )";

        if (mysqli_query($conn, $sql)) {
            echo "/ Tb Al Up ";
        } 
        else {
            echo "Error creating table Al: " . mysqli_error($conn);
        }

    disconnect_db($conn);

// ------------------------------------INSERT ALUNO----------------------------------------------------------//

    $conn = connect_db();

        $sql = "INSERT INTO aluno VALUES 
            ('Andre Alex Jankoski', 'andre.alex@ufpr.br',20220048),
            ('Joao Vitor Araujo dos Santos', 'joao.araujo@ufpr.br', 20220046 ),
            ('Aluno Testando da Silva','aluno.teste@ufpr.br', 99999999)
        ";

        if (mysqli_query($conn, $sql)) {
            echo "/ R Al Up ";
        } 
        else {
            echo "Error inserting into Al: " . mysqli_error($conn);
        }

    disconnect_db($conn);

?>