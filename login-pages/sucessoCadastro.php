<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro Realizado</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      height: 100vh;
      background: linear-gradient(135deg, #3cb878, #2da283, #1e8c8e);
      display: flex;
      justify-content: center;
      align-items: center;
      color: #fff;
    }

    .sucesso {
      background-color: #ffffff;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      text-align: center;
      color: #333;
      max-width: 400px;
      width: 90%;
    }

    .sucesso h1 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    .sucesso a {
      display: inline-block;
      margin-top: 20px;
      padding: 12px 24px;
      background-color: #1e8c8e;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    .sucesso a:hover {
      background-color: #1e8c8e;
    }
  </style>
</head>
<body>
  <div class="sucesso">
    <h1>Cadastro Realizado com Sucesso!</h1>
    <a href="login.php">Ir para a página de Login</a>
  </div>
</body>
</html>
