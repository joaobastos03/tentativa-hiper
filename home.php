<?php
    include("login-pages\protect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bem vindo <?php echo $_SESSION["name"]?></h1>
    <br><br><br><br>
    <a href="login-pages\logout.php">Sair</a><br><br><br><br>

    <a href="settings.php">Configurações do HIPERFLUXOGRAMA</a>
</body>
</html>