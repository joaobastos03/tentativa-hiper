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
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
        <input type="text" placeholder="Email" name="email" required><br><br>
        <input type="password" placeholder="Senha" name="senha" required><br><br>
        <input type="text" placeholder="nome" name="name"><br><br>
        <input type="submit" name="submit">
    </form>
</body>
</html>-->

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro Moderno</title>
  <link rel="stylesheet" href="style_cadastro.css">
</head>
<body>

  <div class="login-box cadastro">
    <h2>Cadastrar Usuário</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" name="nome" placeholder="Seu nome" required>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="seu@email.com" required>
      </div>

      <div class="form-group">
        <label for="senha">Senha</label>
        <input type="password" name="senha" placeholder="Mínimo 6 caracteres" required minlength="6">
      </div>

      <div class="form-group">
        <label for="curso">Qual seu curso?</label>
        <select name="curso" class="form-select" required>
          <option value="">Selecione seu curso</option>
          <option value="Engenharia Mecânica">Engenharia Mecânica</option>
          <option value="Engenharia Elétrica">Engenharia Elétrica</option>
          <option value="Engenharia Civil">Engenharia Civil</option>
          <option value="Engenharia de Produção">Engenharia de Produção</option>
          <option value="Medicina">Medicina</option>
          <option value="Ciência da Computação">Ciência da Computação</option>
          <option value="Direito">Direito</option>
        </select>
      </div>

      <div class="form-group">
        <label for="vinculo">Vínculo com a UFF</label>
        <select name="vinculo" class="form-select" required>
          <option value="">Selecione seu vínculo</option>
          <option value="Docente">Docente</option>
          <option value="Discente">Discente</option>
          <option value="Funcionario">Funcionário</option>
          <option value="Sem vínculo com a UFF">Sem vínculo com a UFF</option>
        </select>
      </div>

      <div class="form-group">
        <label>Gênero</label>
        <div class="radio-group">
          <label class="radio-option">
            <input type="radio" name="genero" value="Masculino" required>
            Masculino
          </label>
          <label class="radio-option">
            <input type="radio" name="genero" value="Feminino">
            Feminino
          </label>
          <label class="radio-option">
            <input type="radio" name="genero" value="Outro">
            Outro(a)
          </label>
        </div>
      </div>

      <div class="form-group">
        <label for="raca">Raça/Cor</label>
        <select name="raca" class="form-select" required>
          <option value="" disabled selected>Selecione sua raça/cor</option>
          <option value="Branco">Branco</option>
          <option value="Preto">Preto</option>
          <option value="Pardo">Pardo</option>
          <option value="Indígena">Indígena</option>
          <option value="Amarelo">Amarelo</option>
        </select>
      </div>

      <button type="submit" class="login-button">Cadastrar</button>
    </form>

    <div class="footer-text">
      <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
    </div>
  </div>

</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
        $senha = $_POST["senha"];
        $curso = $_POST["curso"];
        $vinculo = $_POST["vinculo"];
        $genero = $_POST["genero"];
        $raca = $_POST["raca"];

        if(!empty($email) && !empty($senha) &&!empty($nome)){
            $hash = password_hash($senha, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (nome, email, senha, curso, vinculo, genero, raca) 
                    VALUES ('$nome', '$email', '$hash', '$curso', '$vinculo', '$genero', '$raca')";   
            

            try{
                mysqli_query($conn, $sql);
            }
            catch(mysqli_sql_exception){
                echo"Falha no cadastro de usuário". $mysqli_error;
            }

            header("Location: sucessoCadastro.php");
        }
  
    }

    mysqli_close($conn);
?>