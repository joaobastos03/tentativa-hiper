<?php
  include("database.php")

?>

<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="?php htmlspecialchars($_SERVER["PHP_SELF"])?" method="POST">
        <input type="text" placeholder="Email" name="email"><br><br>
        <input type="password" placeholder="Senha" name="senha"><br><br>
        <input type="submit" name="submit">
    </form>
</body>
</html> -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Moderno</title>
  <link rel="stylesheet" href="style_login.css">
</head>
<body>

  <div class="login-box">
    <h2>Entrar na Conta</h2>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="seu@email.com" required>
      </div>

      <div class="form-group">
        <label for="senha">Senha</label>
        <input type="password" name="senha" placeholder="******" required>
      </div>

      <button type="submit" class="login-button">Entrar</button>
    </form>

    <div class="footer-text">
      <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
    </div>
  </div>

</body>
</html>


<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $senha = $_POST['senha'];

        if(!empty($email) && !empty($senha)){
            $sql = "SELECT * FROM usuarios WHERE email = '$email'";
            $sql_query = $conn->query($sql) or die("Falha na execução do código SQL: ".$mysqli->error);

            $qntd = $sql_query->num_rows;
            if($qntd == 1){
                $user = $sql_query->fetch_assoc();
                if(password_verify($senha, $user['senha'])){
                    if(!isset($_SESSION)){
                        session_start();
                        $_SESSION['id'] = $user['id'];
                        $_SESSION['name'] = $user['nome'];
                        $_SESSION['email'] = $user['email'];
                        header("Location: ../home.php");
                        exit();
                    }
                }
                else{
                    echo"Usuário ou Senha errado, tente novamente";
                }
            }
            else{
                echo"usuário não cadastrado";
            }
        }
    }

    mysqli_close($conn);
?>