<?php
    include("login-pages/protect.php");
    include("login-pages/database.php");

    $email = $_SESSION['email'];
    $disciplinasSalvas = [];

    // Carrega os dados salvos do banco de dados da tabela optativas
    $sql = "SELECT cursadas FROM optativas WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $disciplinasSalvas = explode(",", $row['cursadas']);
    }
    mysqli_stmt_close($stmt);

    function checked($value, $array) {
        return in_array($value, $array) ? "checked" : "";
    }

    // Load elective courses data from JSON
    $optativasJson = file_get_contents('optativas.json');
    $optativasData = json_decode($optativasJson, true);

    // Load mandatory courses data from JSON
    $obrigatoriasJson = file_get_contents('obrigatorias.json');
    $obrigatoriasData = json_decode($obrigatoriasJson, true);

    // Group courses by area
    $coursesByArea = [];
    foreach ($optativasData as $codigo => $dados) {
        $area = $dados['area'];
        if (!isset($coursesByArea[$area])) {
            $coursesByArea[$area] = [];
        }
        $coursesByArea[$area][$codigo] = $dados;
    }

    // Create a mapping of all course codes to their names (both elective and mandatory)
    $courseNames = [];
    foreach ($optativasData as $codigo => $dados) {
        $courseNames[$codigo] = $dados['titulo'];
    }
    foreach ($obrigatoriasData as $codigo => $dados) {
        $courseNames[$codigo] = $dados['titulo'];
    }

    // Define area colors (from the JSON)
    $areaColors = [
        'Projetos Mecânicos' => 'azul',
        'Materiais e Processos de Fabricação' => 'laranja',
        'Termociências' => 'vermelho',
        'Automação e Controle' => 'cinza',
        'Manutenção e Confiabilidade' => 'marrom',
        'Simulação Computacional' => 'roxo',
        'Empreendedorismo e Inovação Tecnológica' => 'rosa',
        'Energia' => 'verde'
    ];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disciplinas Optativas por Ênfase</title>
    <link rel="stylesheet" href="src\css\style_settings.css">
    <style>
        .disciplina-item {
            position: relative;
        }
        .disciplina-item .tooltip {
            visibility: hidden;
            width: 300px;
            background-color: #2d3748;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 10px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 14px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .disciplina-item .tooltip::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #2d3748 transparent transparent transparent;
        }
        .disciplina-item:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }
        .disciplina-info {
            font-size: 12px;
            color: #718096;
            margin-top: 4px;
        }
    </style>
</head>
<body>
    <div class="settings-container">
        <div class="settings-header">
            <h2>Disciplinas Optativas por Área de Ênfase</h2>
            <p class="subtitle">Marque as disciplinas optativas que você já cursou ou deseja cursar</p>
        </div>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <?php foreach ($coursesByArea as $area => $courses): ?>
                <div class="periodo-section">
                    <h3 class="periodo-title" style="border-left-color: <?php 
                        switch($areaColors[$area]) {
                            case 'azul': echo '#3182ce'; break;
                            case 'laranja': echo '#ed8936'; break;
                            case 'vermelho': echo '#e53e3e'; break;
                            case 'cinza': echo '#718096'; break;
                            case 'marrom': echo '#b7791f'; break;
                            case 'roxo': echo '#805ad5'; break;
                            case 'rosa': echo '#d53f8c'; break;
                            case 'verde': echo '#38a169'; break;
                            default: echo '#667eea';
                        }
                    ?>;">
                        <?php echo $area; ?>
                    </h3>
                    <div class="disciplinas-grid">
                        <?php foreach ($courses as $codigo => $disciplina): ?>
                            <div class="disciplina-item">
                                <input type="checkbox" name="optativas[]" value="<?php echo $codigo; ?>" id="<?php echo $codigo; ?>" <?= checked($codigo, $disciplinasSalvas) ?>>
                                <label for="<?php echo $codigo; ?>" class="disciplina-label">
                                    <span class="disciplina-codigo"><?php echo $codigo; ?></span>
                                    <span class="disciplina-nome"><?php echo $disciplina['titulo']; ?></span>
                                    <span class="disciplina-info"><?php echo $disciplina['horas']; ?> horas</span>
                                </label>
                                <?php if (!empty($disciplina['requisitos']) && is_array($disciplina['requisitos'])): ?>
                                    <div class="tooltip">
                                        <strong>Pré-requisitos:</strong><br>
                                        <?php 
                                            $reqNames = [];
                                            foreach ($disciplina['requisitos'] as $reqCodigo) {
                                                if (isset($courseNames[$reqCodigo])) {
                                                    $reqNames[] = $courseNames[$reqCodigo] . " ($reqCodigo)";
                                                } else {
                                                    $reqNames[] = $reqCodigo; // Fallback to code if name not found
                                                }
                                            }
                                            echo implode('<br>', $reqNames);
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="form-actions">
                <button type="submit" class="save-button">
                    <i class="icon-save"></i> Salvar Progresso
                </button>
                <a href="home.php" class="back-link">
                    <i class="icon-arrow-left"></i> Voltar para Home
                </a>
            </div>
        </form>
    </div>
</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $optativasArray = $_POST["optativas"] ?? [];
        $optativasString = implode(",", $optativasArray);

        // Verifica se o usuário já tem dados salvos na tabela optativas
        $sql_check = "SELECT id FROM optativas WHERE email = ?";
        $stmt_check = mysqli_prepare($conn, $sql_check);
        mysqli_stmt_bind_param($stmt_check, "s", $email);
        mysqli_stmt_execute($stmt_check);
        $result = mysqli_stmt_get_result($stmt_check);

        if (mysqli_num_rows($result) > 0) {
            // Atualiza os dados existentes
            $sql_update = "UPDATE optativas SET cursadas = ? WHERE email = ?";
            $stmt_update = mysqli_prepare($conn, $sql_update);
            mysqli_stmt_bind_param($stmt_update, "ss", $optativasString, $email);
            mysqli_stmt_execute($stmt_update);
            mysqli_stmt_close($stmt_update);
        } else {
            // Insere novo registro
            $sql_insert = "INSERT INTO optativas (email, cursadas) VALUES (?, ?)";
            $stmt_insert = mysqli_prepare($conn, $sql_insert);
            mysqli_stmt_bind_param($stmt_insert, "ss", $email, $optativasString);
            mysqli_stmt_execute($stmt_insert);
            mysqli_stmt_close($stmt_insert);
        }

        mysqli_stmt_close($stmt_check);
        mysqli_close($conn);
        
        // Recarrega a página para mostrar os dados atualizados
        echo '<script>window.location.href = "optativas.php";</script>';
        exit();
    }
?>