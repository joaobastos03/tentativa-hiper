<?php
    include("login-pages/protect.php");
    include("login-pages/database.php");

    $email = $_SESSION['email'];
    
    // Totais de horas para cada categoria
    $totalHoras = 3702;       // Total geral do curso
    $totalObrigatorias = 2952; // Horas obrigatórias
    $totalOptativas = 360;     // Horas optativas (limite máximo)
    $totalComplementar = 390;  // Horas complementares
    
    // Inicializa contadores
    $horasConcluidas = 0;
    $horasObrigatorias = 0;
    $horasOptativasBrutas = 0; // Total de horas optativas sem limite
    $horasOptativas = 0;       // Horas optativas válidas (até 360h)
    $horasComplementares = 0;

    // 1. Busca e cálculo das matérias obrigatórias
    $sql_obrigatorias = "SELECT cursadas FROM progresso WHERE email = ?";
    $stmt_obr = $conn->prepare($sql_obrigatorias);
    $stmt_obr->bind_param("s", $email);
    $stmt_obr->execute();
    $result_obr = $stmt_obr->get_result();

    if ($row = $result_obr->fetch_assoc()) {
        $cursadas_array = explode(",", $row['cursadas']);
        $materias_json = json_decode(file_get_contents('obrigatorias.json'), true);
        
        foreach ($cursadas_array as $codigo) {
            if (isset($materias_json[$codigo])) {
                $horas = intval($materias_json[$codigo]['horas']);
                $horasObrigatorias += $horas;
                $horasConcluidas += $horas;
            }
        }
    }
    $stmt_obr->close();

    // 2. Busca e cálculo das matérias optativas (com limite de 360h)
    $sql_optativas = "SELECT materias FROM optativas WHERE email = ?";
    $stmt_opt = $conn->prepare($sql_optativas);
    $stmt_opt->bind_param("s", $email);
    $stmt_opt->execute();
    $result_opt = $stmt_opt->get_result();

    if ($row = $result_opt->fetch_assoc()) {
        $optativas_array = explode(",", $row['materias']);
        $optativas_json = json_decode(file_get_contents('optativas.json'), true);

        // Calcula total bruto de horas optativas
        foreach ($optativas_array as $codigo) {
            if (isset($optativas_json[$codigo])) {
                $horasOptativasBrutas += intval($optativas_json[$codigo]['horas']);
            }
        }
        
        // Aplica o limite máximo de 360 horas
        $horasOptativas = min($horasOptativasBrutas, $totalOptativas);
        $horasConcluidas += $horasOptativas;
    }
    $stmt_opt->close();

    // 3. Cálculo das porcentagens
    $porcentagemTotal = $totalHoras > 0 ? min(100, ($horasConcluidas / $totalHoras) * 100) : 0;
    $porcentagemObrigatorias = $totalObrigatorias > 0 ? min(100, ($horasObrigatorias / $totalObrigatorias) * 100) : 0;
    $porcentagemOptativas = $totalOptativas > 0 ? min(100, ($horasOptativas / $totalOptativas) * 100) : 0;
    $porcentagemComplementar = $totalComplementar > 0 ? min(100, ($horasComplementares / $totalComplementar) * 100) : 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progresso do Curso</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        a {
            text-decoration: none;
        }

        .progress-container {
            width: 100%;
            max-width: 800px;
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #2d3748;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .progress-section {
            margin-bottom: 25px;
            position: relative;
        }

        .progress-title {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            color: #4a5568;
        }

        .progress-title h3 {
            font-size: 16px;
            font-weight: 600;
        }

        .progress-title .percentage {
            font-size: 16px;
            font-weight: 700;
            color: #2d3748;
        }

        .progress-bar {
            width: 100%;
            height: 20px;
            background-color: #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .progress-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 0.5s ease;
        }

        /* Cores diferentes para cada tipo */
        .progress-fill.total {
            background: linear-gradient(90deg, #48bb78, #38a169);
        }
        .progress-fill.obrigatorias {
            background: linear-gradient(90deg, #4299e1, #3182ce);
        }
        .progress-fill.optativas {
            background: linear-gradient(90deg, #9f7aea, #805ad5);
        }
        .progress-fill.complementar {
            background: linear-gradient(90deg, #ed8936, #dd6b20);
        }

        .progress-details {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #718096;
            margin-bottom: 8px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .action-btn {
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 6px;
            border: none;
        }

        .action-btn i {
            font-size: 14px;
        }

        .btn-primary {
            background-color: #4299e1;
            color: white;
        }

        .btn-primary:hover {
            background-color: #3182ce;
        }

        .btn-secondary {
            background-color: #e2e8f0;
            color: #4a5568;
        }

        .btn-secondary:hover {
            background-color: #cbd5e0;
        }

        /* Cores específicas para cada seção */
        .obrigatorias-btn { background-color: #3182ce; }
        .obrigatorias-btn:hover { background-color: #2c5282; }
        
        .optativas-btn { background-color: #805ad5; }
        .optativas-btn:hover { background-color: #6b46c1; }
        
        .complementar-btn { background-color: #dd6b20; }
        .complementar-btn:hover { background-color: #c05621; }

        /* Ícones do Font Awesome */
        @import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css");
    </style>
</head>
<body>
    <div class="progress-container">
        <div class="header">
            <h1>Progresso Acadêmico</h1>
            <p>Resumo das horas concluídas por categoria</p>
        </div>

        <!-- Progresso Total -->
        <div class="progress-section">
            <div class="progress-title">
                <h3>Progresso Geral</h3>
                <span class="percentage"><?php echo number_format($porcentagemTotal, 1); ?>%</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill total" style="width: <?php echo $porcentagemTotal; ?>%"></div>
            </div>
            <div class="progress-details">
                <span><?php echo $horasConcluidas; ?>h de <?php echo $totalHoras; ?>h</span>
                <span><?php echo $totalHoras - $horasConcluidas; ?>h restantes</span>
            </div>
        </div>

        <!-- Obrigatórias -->
        <div class="progress-section">
            <div class="progress-title">
                <h3>Matérias Obrigatórias</h3>
                <span class="percentage"><?php echo number_format($porcentagemObrigatorias, 1); ?>%</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill obrigatorias" style="width: <?php echo $porcentagemObrigatorias; ?>%"></div>
            </div>
            <div class="progress-details">
                <span><?php echo $horasObrigatorias; ?>h de <?php echo $totalObrigatorias; ?>h</span>
                <span><?php echo $totalObrigatorias - $horasObrigatorias; ?>h restantes</span>
            </div>
            <div class="action-buttons">
                <a href="settings.php">
                    <button class="action-btn obrigatorias-btn" onclick="adicionarHoras('obrigatorias')">
                        <i class="fas fa-plus"></i> Adicionar Horas
                    </button>
                </a>
                <button class="action-btn btn-secondary" onclick="gerenciarMaterias('obrigatorias')">
                    <i class="fas fa-tasks"></i> Gerenciar
                </button>
            </div>
        </div>

        <!-- Optativas -->
        <div class="progress-section">
            <div class="progress-title">
                <h3>Matérias Optativas</h3>
                <span class="percentage"><?php echo number_format($porcentagemOptativas, 1); ?>%</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill optativas" style="width: <?php echo $porcentagemOptativas; ?>%"></div>
            </div>
            <div class="progress-details">
                <span><?php echo $horasOptativas; ?>h de <?php echo $totalOptativas; ?>h</span>
                <span><?php echo $totalOptativas - $horasOptativas; ?>h restantes</span>
            </div>
            <div class="action-buttons">
                <a href="optativas.php">
                    <button class="action-btn optativas-btn" onclick="adicionarHoras('optativas')">
                        <i class="fas fa-plus"></i> Adicionar Horas
                    </button>
                </a>
                <button class="action-btn btn-secondary" onclick="verDetalhes('optativas')">
                    <i class="fas fa-list"></i> Ver Detalhes
                </button>
            </div>
        </div>

        <!-- Complementares -->
        <div class="progress-section">
            <div class="progress-title">
                <h3>Atividades Complementares</h3>
                <span class="percentage"><?php echo number_format($porcentagemComplementar, 1); ?>%</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill complementar" style="width: <?php echo $porcentagemComplementar; ?>%"></div>
            </div>
            <div class="progress-details">
                <span><?php echo $horasComplementares; ?>h de <?php echo $totalComplementar; ?>h</span>
                <span><?php echo $totalComplementar - $horasComplementares; ?>h restantes</span>
            </div>
            <div class="action-buttons">
                <button class="action-btn complementar-btn" onclick="adicionarHoras('complementares')">
                    <i class="fas fa-plus"></i> Adicionar Horas
                </button>
                <button class="action-btn btn-secondary" onclick="enviarCertificado()">
                    <i class="fas fa-upload"></i> Enviar Certificado
                </button>
            </div>
        </div>
    </div>

    <script>
        // Funções placeholder para as ações dos botões
        //function adicionarHoras(tipo) {
        //    alert(`Abrir formulário para adicionar horas ${tipo}`);
            // Implementação futura: abrir modal ou redirecionar
        //}
        
        function gerenciarMaterias(tipo) {
            alert(`Abrir gerenciador de matérias ${tipo}`);
            // Implementação futura
        }
        
        function verDetalhes(tipo) {
            alert(`Abrir detalhes de ${tipo}`);
            // Implementação futura
        }
        
        function enviarCertificado() {
            alert('Abrir formulário de envio de certificado');
            // Implementação futura
        }
    </script>
</body>
</html>