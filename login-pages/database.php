<?php
    $dbHost = 'LocalHost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'hiperfluxograma';

    try {
    $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
    }
    catch(mysqli_sql_exception){
        die("Falha ao conectar ao Banco de Dados". $mysqli_connect_error());
    }

?>