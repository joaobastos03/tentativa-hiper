<?php
    include("login-pages/protect.php");
    include("login-pages/database.php");
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações Salvas</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #4facfe, #00f2fe, #235aa6);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .confirmation-box {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        .confirmation-box h1 {
            color: #2d3748;
            margin-bottom: 20px;
            font-size: 28px;
        }

        .confirmation-icon {
            font-size: 60px;
            color: #48bb78;
            margin-bottom: 20px;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #235aa6;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .back-link:hover {
            background-color: #1a4678;
        }

        @media (max-width: 500px) {
            .confirmation-box {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="confirmation-box">
        <div class="confirmation-icon">✓</div>
        <h1>Configurações Salvas com Sucesso!</h1>
        <p>Suas configurações de progresso acadêmico foram atualizadas.</p>
        <a href="home.php" class="back-link">Voltar para Home</a>
    </div>
</body>
</html>