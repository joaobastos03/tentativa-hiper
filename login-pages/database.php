<?php
    $dbHost = 'mUQyCplkYOrCpJOqfMZrJttPKFKrOygY';
    $dbUsername = 'root';
    $dbPassword = 'mUQyCplkYOrCpJOqfMZrJttPKFKrOygY';
    $dbName = 'teste_railway';

    try {
    $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
    }
    catch(mysqli_sql_exception){
        die("Falha ao conectar ao Banco de Dados". $mysqli_connect_error());
    }

?>