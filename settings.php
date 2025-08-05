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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="disciplinas-container">
            <!-- 1º Período -->
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="GGM00137" id="GGM00137" <?= checked("GGM00137", $disciplinasSalvas) ?>>
                <label for="GGM00137">Fundamentos de Cálculo e Geometria</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="GMA00154" id="GMA00154" <?= checked("GMA00154", $disciplinasSalvas) ?>>
                <label for="GMA00154">Cálculo 1</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="GQI00042" id="GQI00042" <?= checked("GQI00042", $disciplinasSalvas) ?>>
                <label for="GQI00042">Química Geral e Inorgânica Experimental III</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00188" id="TEM00188" <?= checked("TEM00188", $disciplinasSalvas) ?>>
                <label for="TEM00188">Introdução à Engenharia Mecânica</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TER00108" id="TER00108" <?= checked("TER00108", $disciplinasSalvas) ?>>
                <label for="TER00108">Engenharia e Meio Ambiente</label>
            </div>
            
            <!-- 2º Período -->
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="GAN00140" id="GAN00140" <?= checked("GAN00140", $disciplinasSalvas) ?>>
                <label for="GAN00140">Álgebra Linear</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="GFI00158" id="GFI00158" <?= checked("GFI00158", $disciplinasSalvas) ?>>
                <label for="GFI00158">Física I</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="GFI00161" id="GFI00161" <?= checked("GFI00161", $disciplinasSalvas) ?>>
                <label for="GFI00161">Física Experimental I</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="GMA00155" id="GMA00155" <?= checked("GMA00155", $disciplinasSalvas) ?>>
                <label for="GMA00155">Cálculo 2</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TCC00326" id="TCC00326" <?= checked("TCC00326", $disciplinasSalvas) ?>>
                <label for="TCC00326">Programação de Computadores</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TDT00076" id="TDT00076" <?= checked("TDT00076", $disciplinasSalvas) ?>>
                <label for="TDT00076">Fundamentos de Desenho Técnico II</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00276" id="TEM00276" <?= checked("TEM00276", $disciplinasSalvas) ?>>
                <label for="TEM00276">Problemas em Engenharia Mecânica I</label>
            </div>
            
            <!-- 3º Período -->
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="GFI00160" id="GFI00160" <?= checked("GFI00160", $disciplinasSalvas) ?>>
                <label for="GFI00160">Física III</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="GFI00163" id="GFI00163" <?= checked("GFI00163", $disciplinasSalvas) ?>>
                <label for="GFI00163">Física Experimental III</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="GMA00156" id="GMA00156" <?= checked("GMA00156", $disciplinasSalvas) ?>>
                <label for="GMA00156">Cálculo 3</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="GMA00158" id="GMA00158" <?= checked("GMA00158", $disciplinasSalvas) ?>>
                <label for="GMA00158">Cálculo 4</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TDT00041" id="TDT00041" <?= checked("TDT00041", $disciplinasSalvas) ?>>
                <label for="TDT00041">Desenho de Projetos Mecânicos</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00200" id="TEM00200" <?= checked("TEM00200", $disciplinasSalvas) ?>>
                <label for="TEM00200">Métodos Computacionais em Engenharia Mecânica</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00277" id="TEM00277" <?= checked("TEM00277", $disciplinasSalvas) ?>>
                <label for="TEM00277">Problemas em Engenharia Mecânica II</label>
            </div>
            
            <!-- 4º Período -->
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="GET00177" id="GET00177" <?= checked("GET00177", $disciplinasSalvas) ?>>
                <label for="GET00177">Estatística Básica</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="GFI00159" id="GFI00159" <?= checked("GFI00159", $disciplinasSalvas) ?>>
                <label for="GFI00159">Física II</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="GFI00162" id="GFI00162" <?= checked("GFI00162", $disciplinasSalvas) ?>>
                <label for="GFI00162">Física Experimental II</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="GMA00162" id="GMA00162" <?= checked("GMA00162", $disciplinasSalvas) ?>>
                <label for="GMA00162">Cálculo 5</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00187" id="TEM00187" <?= checked("TEM00187", $disciplinasSalvas) ?>>
                <label for="TEM00187">Ciência e Tecnologia</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00190" id="TEM00190" <?= checked("TEM00190", $disciplinasSalvas) ?>>
                <label for="TEM00190">Estática</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00275" id="TEM00275" <?= checked("TEM00275", $disciplinasSalvas) ?>>
                <label for="TEM00275">Termodinâmica I</label>
            </div>
            
            <!-- 5º Período -->
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="GFI00155" id="GFI00155" <?= checked("GFI00155", $disciplinasSalvas) ?>>
                <label for="GFI00155">Física Experimental IV</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="GFI00171" id="GFI00171" <?= checked("GFI00171", $disciplinasSalvas) ?>>
                <label for="GFI00171">Física IV</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00184" id="TEM00184" <?= checked("TEM00184", $disciplinasSalvas) ?>>
                <label for="TEM00184">Mecânica dos Fluidos I</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00194" id="TEM00194" <?= checked("TEM00194", $disciplinasSalvas) ?>>
                <label for="TEM00194">Mecânica dos Sólidos I</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00209" id="TEM00209" <?= checked("TEM00209", $disciplinasSalvas) ?>>
                <label for="TEM00209">Dinâmica I</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00211" id="TEM00211" <?= checked("TEM00211", $disciplinasSalvas) ?>>
                <label for="TEM00211">Introdução à Engenharia de Fabricação</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00279" id="TEM00279" <?= checked("TEM00279", $disciplinasSalvas) ?>>
                <label for="TEM00279">Termodinâmica II</label>
            </div>
            
            <!-- 6º Período -->
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00189" id="TEM00189" <?= checked("TEM00189", $disciplinasSalvas) ?>>
                <label for="TEM00189">Engenharia dos Materiais I-A</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00193" id="TEM00193" <?= checked("TEM00193", $disciplinasSalvas) ?>>
                <label for="TEM00193">Transferência de Calor</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00195" id="TEM00195" <?= checked("TEM00195", $disciplinasSalvas) ?>>
                <label for="TEM00195">Mecânica dos Sólidos II</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00199" id="TEM00199" <?= checked("TEM00199", $disciplinasSalvas) ?>>
                <label for="TEM00199">Vibrações e Sistemas Mecânicos</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00205" id="TEM00205" <?= checked("TEM00205", $disciplinasSalvas) ?>>
                <label for="TEM00205">Metrologia Industrial</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00280" id="TEM00280" <?= checked("TEM00280", $disciplinasSalvas) ?>>
                <label for="TEM00280">Máquinas Térmicas I</label>
            </div>
            
            <!-- 7º Período -->
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEE00113" id="TEE00113" <?= checked("TEE00113", $disciplinasSalvas) ?>>
                <label for="TEE00113">Eletrotécnica</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00047" id="TEM00047" <?= checked("TEM00047", $disciplinasSalvas) ?>>
                <label for="TEM00047">Usinagem</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00051" id="TEM00051" <?= checked("TEM00051", $disciplinasSalvas) ?>>
                <label for="TEM00051">Engenharia dos Materiais II-A</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00197" id="TEM00197" <?= checked("TEM00197", $disciplinasSalvas) ?>>
                <label for="TEM00197">Elementos de Máquinas I</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00210" id="TEM00210" <?= checked("TEM00210", $disciplinasSalvas) ?>>
                <label for="TEM00210">Máquinas Hidráulicas</label>
            </div>
            
            <!-- 8º Período -->
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00198" id="TEM00198" <?= checked("TEM00198", $disciplinasSalvas) ?>>
                <label for="TEM00198">Elementos de Máquinas II</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00203" id="TEM00203" <?= checked("TEM00203", $disciplinasSalvas) ?>>
                <label for="TEM00203">Fundição, Metalurgia do Pó e Manufatura Aditiva</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00204" id="TEM00204" <?= checked("TEM00204", $disciplinasSalvas) ?>>
                <label for="TEM00204">Soldagem e Ensaios Não-Destrutivos</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEP00108" id="TEP00108" <?= checked("TEP00108", $disciplinasSalvas) ?>>
                <label for="TEP00108">Administração Aplicada à Engenharia</label>
            </div>
            
            <!-- 9º e 10º Períodos -->
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00212" id="TEM00212" <?= checked("TEM00212", $disciplinasSalvas) ?>>
                <label for="TEM00212">Projeto de Engenharia Mecânica I</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00214" id="TEM00214" <?= checked("TEM00214", $disciplinasSalvas) ?>>
                <label for="TEM00214">Estágio Obrigatório em Engenharia Mecânica I</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEP00109" id="TEP00109" <?= checked("TEP00109", $disciplinasSalvas) ?>>
                <label for="TEP00109">Economia Aplicada à Engenharia</label>
            </div>
            <div class="disciplina-item">
                <input type="checkbox" name="obrigatorias[]" value="TEM00213" id="TEM00213" <?= checked("TEM00213", $disciplinasSalvas) ?>>
                <label for="TEM00213">Projeto de Engenharia Mecânica II</label>
            </div>
        </div><br><br>

        <label for="enfase">Qual a ênfase de sua formação?</label>
        <select name="enfase">
            <option value="">Selecione sua ênfase</option>
            <option value="projetos mecanicos" <?= selected("projetos mecanicos", $enfaseSalva) ?>>Projetos Mecânicos</option>
            <option value="fabricacao" <?= selected("fabricacao", $enfaseSalva) ?>>Materiais e Processos de Fabricação</option>
            <option value="termociencias" <?= selected("termociencias", $enfaseSalva) ?>>Termociências</option>
            <option value="automacao" <?= selected("automacao", $enfaseSalva) ?>>Automação e Controle</option>
            <option value="manutencao" <?= selected("manutencao", $enfaseSalva) ?>>Manutenção e Confiabilidade</option>
            <option value="simulacao" <?= selected("simulacao", $enfaseSalva) ?>>Simulação Computacional e Modelagem</option>
            <option value="empreendedorismo" <?= selected("empreendedorismo", $enfaseSalva) ?>>Empreendedorismo e Inovação Tecnológica</option>
            <option value="energia" <?= selected("energia", $enfaseSalva) ?>>Energia</option>
        </select><br><br>
        
        <button type="submit">Salvar Disciplinas Cursadas</button>
    </form>
    <br><br><br><br>
    <a href="home.php">Voltar para o home</a>
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