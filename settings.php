<?php
    include("login-pages/protect.php");
    include("login-pages/database.php");

    $email = $_SESSION['email'];
    $disciplinasSalvas = [];
    $enfaseSalva = "";

    // Carrega os dados salvos do banco de dados
    $sql = "SELECT cursadas, enfase FROM progresso WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $disciplinasSalvas = explode(",", $row['cursadas']);
        $enfaseSalva = $row['enfase'];
    }
    mysqli_stmt_close($stmt);

    function checked($value, $array) {
        return in_array($value, $array) ? "checked" : "";
    }
    function selected($value, $current) {
        return $value == $current ? "selected" : "";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações do Progresso</title>
    <link rel="stylesheet" href="style_settings.css">
</head>
<body>
    <div class="settings-container">
        <div class="settings-header">
            <h2>Configurações do Progresso Acadêmico</h2>
            <p class="subtitle">Marque as disciplinas já cursadas e selecione sua ênfase</p>
        </div>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <!-- 1º Período -->
            <div class="periodo-section">
                <h3 class="periodo-title">1º Período</h3>
                <div class="disciplinas-grid">
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="GGM00137" id="GGM00137" <?= checked("GGM00137", $disciplinasSalvas) ?>>
                        <label for="GGM00137" class="disciplina-label">
                            <span class="disciplina-codigo">GGM00137</span>
                            <span class="disciplina-nome">Fundamentos de Cálculo e Geometria</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="GMA00154" id="GMA00154" <?= checked("GMA00154", $disciplinasSalvas) ?>>
                        <label for="GMA00154" class="disciplina-label">
                            <span class="disciplina-codigo">GMA00154</span>
                            <span class="disciplina-nome">Cálculo 1</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="GQI00042" id="GQI00042" <?= checked("GQI00042", $disciplinasSalvas) ?>>
                        <label for="GQI00042" class="disciplina-label">
                            <span class="disciplina-codigo">GQI00042</span>
                            <span class="disciplina-nome">Química Geral e Inorgânica Experimental III</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00188" id="TEM00188" <?= checked("TEM00188", $disciplinasSalvas) ?>>
                        <label for="TEM00188" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00188</span>
                            <span class="disciplina-nome">Introdução à Engenharia Mecânica</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TER00108" id="TER00108" <?= checked("TER00108", $disciplinasSalvas) ?>>
                        <label for="TER00108" class="disciplina-label">
                            <span class="disciplina-codigo">TER00108</span>
                            <span class="disciplina-nome">Engenharia e Meio Ambiente</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- 2º Período -->
            <div class="periodo-section">
                <h3 class="periodo-title">2º Período</h3>
                <div class="disciplinas-grid">
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="GAN00140" id="GAN00140" <?= checked("GAN00140", $disciplinasSalvas) ?>>
                        <label for="GAN00140" class="disciplina-label">
                            <span class="disciplina-codigo">GAN00140</span>
                            <span class="disciplina-nome">Álgebra Linear</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="GFI00158" id="GFI00158" <?= checked("GFI00158", $disciplinasSalvas) ?>>
                        <label for="GFI00158" class="disciplina-label">
                            <span class="disciplina-codigo">GFI00158</span>
                            <span class="disciplina-nome">Física I</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="GFI00161" id="GFI00161" <?= checked("GFI00161", $disciplinasSalvas) ?>>
                        <label for="GFI00161" class="disciplina-label">
                            <span class="disciplina-codigo">GFI00161</span>
                            <span class="disciplina-nome">Física Experimental I</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="GMA00155" id="GMA00155" <?= checked("GMA00155", $disciplinasSalvas) ?>>
                        <label for="GMA00155" class="disciplina-label">
                            <span class="disciplina-codigo">GMA00155</span>
                            <span class="disciplina-nome">Cálculo 2</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TCC00326" id="TCC00326" <?= checked("TCC00326", $disciplinasSalvas) ?>>
                        <label for="TCC00326" class="disciplina-label">
                            <span class="disciplina-codigo">TCC00326</span>
                            <span class="disciplina-nome">Programação de Computadores</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TDT00076" id="TDT00076" <?= checked("TDT00076", $disciplinasSalvas) ?>>
                        <label for="TDT00076" class="disciplina-label">
                            <span class="disciplina-codigo">TDT00076</span>
                            <span class="disciplina-nome">Fundamentos de Desenho Técnico II</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00276" id="TEM00276" <?= checked("TEM00276", $disciplinasSalvas) ?>>
                        <label for="TEM00276" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00276</span>
                            <span class="disciplina-nome">Problemas em Engenharia Mecânica I</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- 3º Período -->
            <div class="periodo-section">
                <h3 class="periodo-title">3º Período</h3>
                <div class="disciplinas-grid">
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="GFI00160" id="GFI00160" <?= checked("GFI00160", $disciplinasSalvas) ?>>
                        <label for="GFI00160" class="disciplina-label">
                            <span class="disciplina-codigo">GFI00160</span>
                            <span class="disciplina-nome">Física III</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="GFI00163" id="GFI00163" <?= checked("GFI00163", $disciplinasSalvas) ?>>
                        <label for="GFI00163" class="disciplina-label">
                            <span class="disciplina-codigo">GFI00163</span>
                            <span class="disciplina-nome">Física Experimental III</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="GMA00156" id="GMA00156" <?= checked("GMA00156", $disciplinasSalvas) ?>>
                        <label for="GMA00156" class="disciplina-label">
                            <span class="disciplina-codigo">GMA00156</span>
                            <span class="disciplina-nome">Cálculo 3</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="GMA00158" id="GMA00158" <?= checked("GMA00158", $disciplinasSalvas) ?>>
                        <label for="GMA00158" class="disciplina-label">
                            <span class="disciplina-codigo">GMA00158</span>
                            <span class="disciplina-nome">Cálculo 4</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TDT00041" id="TDT00041" <?= checked("TDT00041", $disciplinasSalvas) ?>>
                        <label for="TDT00041" class="disciplina-label">
                            <span class="disciplina-codigo">TDT00041</span>
                            <span class="disciplina-nome">Desenho de Projetos Mecânicos</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00200" id="TEM00200" <?= checked("TEM00200", $disciplinasSalvas) ?>>
                        <label for="TEM00200" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00200</span>
                            <span class="disciplina-nome">Métodos Computacionais em Engenharia Mecânica</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00277" id="TEM00277" <?= checked("TEM00277", $disciplinasSalvas) ?>>
                        <label for="TEM00277" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00277</span>
                            <span class="disciplina-nome">Problemas em Engenharia Mecânica II</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- 4º Período -->
            <div class="periodo-section">
                <h3 class="periodo-title">4º Período</h3>
                <div class="disciplinas-grid">
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="GET00177" id="GET00177" <?= checked("GET00177", $disciplinasSalvas) ?>>
                        <label for="GET00177" class="disciplina-label">
                            <span class="disciplina-codigo">GET00177</span>
                            <span class="disciplina-nome">Estatística Básica</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="GFI00159" id="GFI00159" <?= checked("GFI00159", $disciplinasSalvas) ?>>
                        <label for="GFI00159" class="disciplina-label">
                            <span class="disciplina-codigo">GFI00159</span>
                            <span class="disciplina-nome">Física II</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="GFI00162" id="GFI00162" <?= checked("GFI00162", $disciplinasSalvas) ?>>
                        <label for="GFI00162" class="disciplina-label">
                            <span class="disciplina-codigo">GFI00162</span>
                            <span class="disciplina-nome">Física Experimental II</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="GMA00162" id="GMA00162" <?= checked("GMA00162", $disciplinasSalvas) ?>>
                        <label for="GMA00162" class="disciplina-label">
                            <span class="disciplina-codigo">GMA00162</span>
                            <span class="disciplina-nome">Cálculo 5</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00187" id="TEM00187" <?= checked("TEM00187", $disciplinasSalvas) ?>>
                        <label for="TEM00187" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00187</span>
                            <span class="disciplina-nome">Ciência e Tecnologia</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00190" id="TEM00190" <?= checked("TEM00190", $disciplinasSalvas) ?>>
                        <label for="TEM00190" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00190</span>
                            <span class="disciplina-nome">Estática</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00275" id="TEM00275" <?= checked("TEM00275", $disciplinasSalvas) ?>>
                        <label for="TEM00275" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00275</span>
                            <span class="disciplina-nome">Termodinâmica I</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- 5º Período -->
            <div class="periodo-section">
                <h3 class="periodo-title">5º Período</h3>
                <div class="disciplinas-grid">
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="GFI00155" id="GFI00155" <?= checked("GFI00155", $disciplinasSalvas) ?>>
                        <label for="GFI00155" class="disciplina-label">
                            <span class="disciplina-codigo">GFI00155</span>
                            <span class="disciplina-nome">Física Experimental IV</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="GFI00171" id="GFI00171" <?= checked("GFI00171", $disciplinasSalvas) ?>>
                        <label for="GFI00171" class="disciplina-label">
                            <span class="disciplina-codigo">GFI00171</span>
                            <span class="disciplina-nome">Física IV</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00184" id="TEM00184" <?= checked("TEM00184", $disciplinasSalvas) ?>>
                        <label for="TEM00184" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00184</span>
                            <span class="disciplina-nome">Mecânica dos Fluidos I</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00194" id="TEM00194" <?= checked("TEM00194", $disciplinasSalvas) ?>>
                        <label for="TEM00194" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00194</span>
                            <span class="disciplina-nome">Mecânica dos Sólidos I</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00209" id="TEM00209" <?= checked("TEM00209", $disciplinasSalvas) ?>>
                        <label for="TEM00209" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00209</span>
                            <span class="disciplina-nome">Dinâmica I</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00211" id="TEM00211" <?= checked("TEM00211", $disciplinasSalvas) ?>>
                        <label for="TEM00211" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00211</span>
                            <span class="disciplina-nome">Introdução à Engenharia de Fabricação</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00279" id="TEM00279" <?= checked("TEM00279", $disciplinasSalvas) ?>>
                        <label for="TEM00279" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00279</span>
                            <span class="disciplina-nome">Termodinâmica II</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- 6º Período -->
            <div class="periodo-section">
                <h3 class="periodo-title">6º Período</h3>
                <div class="disciplinas-grid">
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00189" id="TEM00189" <?= checked("TEM00189", $disciplinasSalvas) ?>>
                        <label for="TEM00189" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00189</span>
                            <span class="disciplina-nome">Engenharia dos Materiais I-A</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00193" id="TEM00193" <?= checked("TEM00193", $disciplinasSalvas) ?>>
                        <label for="TEM00193" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00193</span>
                            <span class="disciplina-nome">Transferência de Calor</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00195" id="TEM00195" <?= checked("TEM00195", $disciplinasSalvas) ?>>
                        <label for="TEM00195" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00195</span>
                            <span class="disciplina-nome">Mecânica dos Sólidos II</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00199" id="TEM00199" <?= checked("TEM00199", $disciplinasSalvas) ?>>
                        <label for="TEM00199" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00199</span>
                            <span class="disciplina-nome">Vibrações e Sistemas Mecânicos</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00205" id="TEM00205" <?= checked("TEM00205", $disciplinasSalvas) ?>>
                        <label for="TEM00205" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00205</span>
                            <span class="disciplina-nome">Metrologia Industrial</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00280" id="TEM00280" <?= checked("TEM00280", $disciplinasSalvas) ?>>
                        <label for="TEM00280" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00280</span>
                            <span class="disciplina-nome">Máquinas Térmicas I</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- 7º Período -->
            <div class="periodo-section">
                <h3 class="periodo-title">7º Período</h3>
                <div class="disciplinas-grid">
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEE00113" id="TEE00113" <?= checked("TEE00113", $disciplinasSalvas) ?>>
                        <label for="TEE00113" class="disciplina-label">
                            <span class="disciplina-codigo">TEE00113</span>
                            <span class="disciplina-nome">Eletrotécnica</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00047" id="TEM00047" <?= checked("TEM00047", $disciplinasSalvas) ?>>
                        <label for="TEM00047" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00047</span>
                            <span class="disciplina-nome">Usinagem</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00051" id="TEM00051" <?= checked("TEM00051", $disciplinasSalvas) ?>>
                        <label for="TEM00051" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00051</span>
                            <span class="disciplina-nome">Engenharia dos Materiais II-A</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00197" id="TEM00197" <?= checked("TEM00197", $disciplinasSalvas) ?>>
                        <label for="TEM00197" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00197</span>
                            <span class="disciplina-nome">Elementos de Máquinas I</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00210" id="TEM00210" <?= checked("TEM00210", $disciplinasSalvas) ?>>
                        <label for="TEM00210" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00210</span>
                            <span class="disciplina-nome">Máquinas Hidráulicas</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- 8º Período -->
            <div class="periodo-section">
                <h3 class="periodo-title">8º Período</h3>
                <div class="disciplinas-grid">
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00198" id="TEM00198" <?= checked("TEM00198", $disciplinasSalvas) ?>>
                        <label for="TEM00198" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00198</span>
                            <span class="disciplina-nome">Elementos de Máquinas II</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00203" id="TEM00203" <?= checked("TEM00203", $disciplinasSalvas) ?>>
                        <label for="TEM00203" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00203</span>
                            <span class="disciplina-nome">Fundição, Metalurgia do Pó e Manufatura Aditiva</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00204" id="TEM00204" <?= checked("TEM00204", $disciplinasSalvas) ?>>
                        <label for="TEM00204" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00204</span>
                            <span class="disciplina-nome">Soldagem e Ensaios Não-Destrutivos</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEP00108" id="TEP00108" <?= checked("TEP00108", $disciplinasSalvas) ?>>
                        <label for="TEP00108" class="disciplina-label">
                            <span class="disciplina-codigo">TEP00108</span>
                            <span class="disciplina-nome">Administração Aplicada à Engenharia</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- 9º e 10º Períodos -->
            <div class="periodo-section">
                <h3 class="periodo-title">9º e 10º Períodos</h3>
                <div class="disciplinas-grid">
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00212" id="TEM00212" <?= checked("TEM00212", $disciplinasSalvas) ?>>
                        <label for="TEM00212" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00212</span>
                            <span class="disciplina-nome">Projeto de Engenharia Mecânica I</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00214" id="TEM00214" <?= checked("TEM00214", $disciplinasSalvas) ?>>
                        <label for="TEM00214" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00214</span>
                            <span class="disciplina-nome">Estágio Obrigatório em Engenharia Mecânica I</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEP00109" id="TEP00109" <?= checked("TEP00109", $disciplinasSalvas) ?>>
                        <label for="TEP00109" class="disciplina-label">
                            <span class="disciplina-codigo">TEP00109</span>
                            <span class="disciplina-nome">Economia Aplicada à Engenharia</span>
                        </label>
                    </div>
                    <div class="disciplina-item">
                        <input type="checkbox" name="obrigatorias[]" value="TEM00213" id="TEM00213" <?= checked("TEM00213", $disciplinasSalvas) ?>>
                        <label for="TEM00213" class="disciplina-label">
                            <span class="disciplina-codigo">TEM00213</span>
                            <span class="disciplina-nome">Projeto de Engenharia Mecânica II</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Seção de Ênfase -->
            <div class="enfase-section">
                <h3 class="section-title">Ênfase da Formação</h3>
                <div class="select-wrapper">
                    <select name="enfase" id="enfase" class="enfase-select">
                        <option value="">Selecione sua ênfase</option>
                        <option value="projetos mecanicos" <?= selected("projetos mecanicos", $enfaseSalva) ?>>Projetos Mecânicos</option>
                        <option value="fabricacao" <?= selected("fabricacao", $enfaseSalva) ?>>Materiais e Processos de Fabricação</option>
                        <option value="termociencias" <?= selected("termociencias", $enfaseSalva) ?>>Termociências</option>
                        <option value="automacao" <?= selected("automacao", $enfaseSalva) ?>>Automação e Controle</option>
                        <option value="manutencao" <?= selected("manutencao", $enfaseSalva) ?>>Manutenção e Confiabilidade</option>
                        <option value="simulacao" <?= selected("simulacao", $enfaseSalva) ?>>Simulação Computacional e Modelagem</option>
                        <option value="empreendedorismo" <?= selected("empreendedorismo", $enfaseSalva) ?>>Empreendedorismo e Inovação Tecnológica</option>
                        <option value="energia" <?= selected("energia", $enfaseSalva) ?>>Energia</option>
                    </select>
                </div>
            </div>

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
        $cursadasArray = $_POST["obrigatorias"] ?? [];
        $cursadasString = implode(",", $cursadasArray);
        $enfase = $_POST["enfase"];

        // Verifica se o usuário já tem dados salvos
        $sql_check = "SELECT * FROM progresso WHERE email = ?";
        $stmt_check = mysqli_prepare($conn, $sql_check);
        mysqli_stmt_bind_param($stmt_check, "s", $email);
        mysqli_stmt_execute($stmt_check);
        $result = mysqli_stmt_get_result($stmt_check);

        if (mysqli_num_rows($result) > 0) {
            // Atualiza
            $sql_update = "UPDATE progresso SET cursadas = ?, enfase = ? WHERE email = ?";
            $stmt_update = mysqli_prepare($conn, $sql_update);
            mysqli_stmt_bind_param($stmt_update, "sss", $cursadasString, $enfase, $email);
            mysqli_stmt_execute($stmt_update);
            mysqli_stmt_close($stmt_update);
        } else {
            // Insere
            $sql_insert = "INSERT INTO progresso (email, cursadas, enfase) VALUES (?, ?, ?)";
            $stmt_insert = mysqli_prepare($conn, $sql_insert);
            mysqli_stmt_bind_param($stmt_insert, "sss", $email, $cursadasString, $enfase);
            mysqli_stmt_execute($stmt_insert);
            mysqli_stmt_close($stmt_insert);
        }

        mysqli_stmt_close($stmt_check);
        mysqli_close($conn);
        
        // Recarrega a página para mostrar os dados atualizados
        echo '<script>window.location.href = "settings.php";</script>';
        exit();
    }
?>