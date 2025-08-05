<?php
    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION['id'])){
        die("Você não pode acessar a página, pois não está logado. <p><a href\"index.php\">Entrar</a><p>");
    }
?>