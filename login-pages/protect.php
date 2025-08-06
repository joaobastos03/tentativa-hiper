<?php
if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['id'])){
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Acesso Restrito</title>
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #4facfe, #00f2fe, #235aa6);
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                color: #333;
            }
            
            .error-container {
                background-color: white;
                border-radius: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                padding: 40px;
                width: 90%;
                max-width: 500px;
                text-align: center;
            }
            
            h1 {
                color: #e74c3c;
                margin-bottom: 20px;
            }
            
            p {
                margin-bottom: 30px;
                line-height: 1.6;
            }
            
            .btn {
                display: inline-block;
                background-color: #3498db;
                color: white;
                padding: 12px 24px;
                border-radius: 5px;
                text-decoration: none;
                font-weight: 500;
                transition: background-color 0.3s;
            }
            
            .btn:hover {
                background-color: #2980b9;
            }
            
            .icon {
                font-size: 50px;
                color: #e74c3c;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <div class="error-container">
            <div class="icon">🔒</div>
            <h1>Acesso Restrito</h1>
            <p>Você precisa estar logado para acessar esta página.</p>
            <a href="login.php" class="btn">Fazer Login</a>
            <p style="margin-top: 20px;">Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
        </div>
    </body>
    </html>
    <?php
    exit();
}
?>