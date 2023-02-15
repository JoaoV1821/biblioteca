<?php
require_once "credentials.php";

    // Create connection
        $conn = mysqli_connect($servername, $username, $password);

    // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

    // Create database
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        if (mysqli_query($conn, $sql)) {
            echo "DB Up";
        } 
        else {
            echo "Error creating database: " . mysqli_error($conn);
        }

        mysqli_close($conn);

// ------------------------------------TABELA----------------------------------------------------------//


    // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

    // SQL to create table
        $sql = "CREATE TABLE IF NOT EXISTS login (
        email VARCHAR(50) NOT NULL,
        senha VARCHAR(60) NOT NULL
        )";

        if (mysqli_query($conn, $sql)) {
            echo "T Up";
        } 
        else {
            echo "Error creating table: " . mysqli_error($conn);
        }

        mysqli_close($conn);

//---------------------------INSERCAO DE DADOS DO PROPRIETARIO------------------------------------//
/*
    // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }

    //  SQL to insert 
        $sql = "INSERT INTO login (email, senha)
        VALUES ('teste@teste.com','teste')";

        if (mysqli_query($conn, $sql)) {
            echo "R Up";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);      
*/
?>