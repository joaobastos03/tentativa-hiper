<?php
    include('login-pages/database.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <title>Fluxograma Completo - Engenharia Mecânica</title>
    <link rel="stylesheet" href="src\css\style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/framework7/6.3.0/css/framework7.bundle.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/framework7/6.3.0/js/framework7.bundle.min.js"></script>
    <script src="app.js"></script>
</head>
<body>

    <div id="rotate-message">
        🔄 Por favor, gire o dispositivo para o modo paisagem
    </div>
    
    <div id="site-content">
            <header>
            <nav>
                <ul>
                    <li><img src="src\imagens\logo pet mec.png" alt=""></li>
                    <li><h1><span>HIPER</span>FLUXOGRAMA</h1></li>
                </ul>
                <div class="links">
                  <ul>
                    <li><a href="login-pages\login.php"><button><span>Login</span></button></a></li>
                    <a href="dados.php"><li><button><span>Dados</span></button></li></a>
                    <a href=""><li><button><span>Monitoria</span></button></li></a>
                    <a href="manutencao.php"><li><button><span>Config.</span></button></li></a>
                  </ul>
                </div>
            </nav>
        </header>

        <main>
            <div class="fileira">
                <!-- ==================== COLUNA 1 (PERÍODO 1) ==================== -->
                <div class="coluna">
                    <div class="box" id="GGM00137" data-requisitos='[]'>
                        <div class="titulo">FUNDAMENTOS DE CÁLCULO E GEOMETRIA</div>
                        <a href="materias/fundamentos.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="GMA00154" data-requisitos='[]'>
                        <div class="titulo">CÁLCULO I</div>
                        <a href="materias/calculo1.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="GQI00042" data-requisitos='[]'>
                        <div class="titulo">QUÍMICA GERAL III</div>
                        <a href="materias/quimica.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00188" data-requisitos='[]'>
                        <div class="titulo">INTRODUÇÃO À ENGENHARIA MECÂNICA</div>
                        <a href="materias/introducao.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TER00108" data-requisitos='[]'>
                        <div class="titulo">ENGENHARIA DE MEIO AMBIENTE</div>
                        <a href="materias/meio-ambiente.html" class="btn">Acesse</a>
                    </div>
                    <div class="box-empty"></div>
                    <div class="box-empty"></div>
                </div>

                <!-- ==================== COLUNA 2 (PERÍODO 2) ==================== -->
                <div class="coluna">
                    <div class="box" id="GAN00140" data-requisitos='["GGM00137"]'>
                        <div class="titulo">ÁLGEBRA LINEAR</div>
                        <a href="materias/algebra.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="GFI00158" data-requisitos='["GGM00137","GMA00154","GAN00140"]'>
                        <div class="titulo">FÍSICA I</div>
                        <a href="materias/fisica1.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="GFI00161" data-requisitos='["GGM00137","GMA00154","GAN00140"]'>
                        <div class="titulo">FÍSICA EXPERIMENTAL I</div>
                        <a href="materias/fisica-exp1.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="GMA00155" data-requisitos='["GMA00154","GGM00137","GAN00140"]'>
                        <div class="titulo">CÁLCULO II</div>
                        <a href="materias/calculo2.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TCC00326" data-requisitos='["GMA00154","GAN00140"]'>
                        <div class="titulo">PROGRAMAÇÃO DE COMPUTADORES</div>
                        <a href="materias/programacao.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TDT00076" data-requisitos='["GGM00137"]'>
                        <div class="titulo">FUNDAMENTOS DE DESENHO TÉCNICO II</div>
                        <a href="materias/desenho-tecnico.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00276" data-requisitos='["GGM00137","GMA00154","TEM00188","GAN00140","GFI00158","GMA00155","TCC00326","TDT00076"]'>
                        <div class="titulo">PROBLEMAS EM ENGENHARIA MECÂNICA I</div>
                        <a href="materias/pem1.html" class="btn">Acesse</a>
                    </div>
                </div>

                <!-- ==================== COLUNA 3 (PERÍODO 3) ==================== -->
                <div class="coluna">
                    <div class="box" id="GFI00160" data-requisitos='["GFI00158"]'>
                        <div class="titulo">FÍSICA III</div>
                        <a href="materias/fisica3.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="GFI00163" data-requisitos='["GFI00158","GFI00160","GMA00155"]'>
                        <div class="titulo">FÍSICA EXPERIMENTAL III</div>
                        <a href="materias/fisica-exp3.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="GMA00156" data-requisitos='["GAN00140","GMA00155"]'>
                        <div class="titulo">CÁLCULO III</div>
                        <a href="materias/calculo3.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="GMA00158" data-requisitos='["GAN00140","GMA00155"]'>
                        <div class="titulo">CÁLCULO IV</div>
                        <a href="materias/calculo4.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TDT00041" data-requisitos='["TDT00076"]'>
                        <div class="titulo">DESENHO DE PROJETOS MECÂNICOS</div>
                        <a href="materias/desenho-projetos.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00200" data-requisitos='["GAN00140","GMA00155","TCC00326"]'>
                        <div class="titulo">MÉTODOS COMPUTACIONAIS</div>
                        <a href="materias/metodos-computacionais.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00277" data-requisitos='["GAN00140","GFI00158","GMA00155","TCC00326","GFI00160","GMA00158","GMA00156","TEM00200"]'>
                        <div class="titulo">PROBLEMAS EM ENGENHARIA MECÂNICA II</div>
                        <a href="materias/pem2.html" class="btn">Acesse</a>
                    </div>
                </div>

                <!-- ==================== COLUNA 4 (PERÍODO 4) ==================== -->
                <div class="coluna">
                    <div class="box" id="GET00177" data-requisitos='["GAN00140","GMA00155"]'>
                        <div class="titulo">ESTATÍSTICA BÁSICA</div>
                        <a href="materias/estatistica.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="GFI00159" data-requisitos='["GFI00158","GMA00156","GMA00158","GMA00162"]'>
                        <div class="titulo">FÍSICA II</div>
                        <a href="materias/fisica2.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="GFI00162" data-requisitos='["GFI00158","GMA00158","GMA00156","GMA00162"]'>
                        <div class="titulo">FÍSICA EXPERIMENTAL II</div>
                        <a href="materias/fisica-exp2.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="GMA00162" data-requisitos='["GMA00158"]'>
                        <div class="titulo">CÁLCULO V</div>
                        <a href="materias/calculo5.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00187" data-requisitos='["TEM00277"]'>
                        <div class="titulo">CIÊNCIA E TECNOLOGIA</div>
                        <a href="materias/ciencia-tecnologia.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00190" data-requisitos='["GFI00158","GMA00155","TEM00276"]'>
                        <div class="titulo">ESTÁTICA</div>
                        <a href="materias/estatica.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00275" data-requisitos='["GMA00155","TEM00276","GFI00160"]'>
                        <div class="titulo">TERMODINÂMICA I</div>
                        <a href="materias/termodinamica1.html" class="btn">Acesse</a>
                    </div>
                </div>

                <!-- ==================== COLUNA 5 (PERÍODO 5) ==================== -->
                <div class="coluna">
                    <div class="box" id="GFI00155" data-requisitos='["GMA00156","GMA00158","GFI00159","GFI00171"]'>
                        <div class="titulo">FÍSICA EXPERIMENTAL IV</div>
                        <a href="materias/fisica-exp4.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="GFI00171" data-requisitos='["GMA00156","GMA00158","GFI00159","GMA00162"]'>
                        <div class="titulo">FÍSICA IV</div>
                        <a href="materias/fisica4.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00184" data-requisitos='["GMA00162"]'>
                        <div class="titulo">MECÂNICA DOS FLUIDOS I</div>
                        <a href="materias/mecanica-fluidos.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00194" data-requisitos='["GMA00158","TEM00190"]'>
                        <div class="titulo">MECÂNICA DOS SÓLIDOS I</div>
                        <a href="materias/mecanica-solidos1.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00209" data-requisitos='["GMA00158","TEM00190"]'>
                        <div class="titulo">DINÂMICA I</div>
                        <a href="materias/dinamica1.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00211" data-requisitos='["TEM00275","GMA00158","TEM00277"]'>
                        <div class="titulo">INTRODUÇÃO À ENGENHARIA DE FABRICAÇÃO</div>
                        <a href="materias/intro-fabricacao.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00279" data-requisitos='["GMA00158","TEM00277"]'>
                        <div class="titulo">TERMODINÂMICA II</div>
                        <a href="materias/termodinamica2.html" class="btn">Acesse</a>
                    </div>
                </div>

                <!-- ==================== COLUNA 6 (PERÍODO 6) ==================== -->
                <div class="coluna">
                    <div class="box" id="TEM00189" data-requisitos='["TEM00194","1 periodo completo","2 periodo completo","3 periodo completo","4 periodo completo"]'>
                        <div class="titulo">ENGENHARIA DOS MATERIAIS I-A</div>
                        <a href="materias/materiais1.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00193" data-requisitos='["TEM00184","TEM00279","1 periodo completo","2 periodo completo","3 periodo completo","4 periodo completo"]'>
                        <div class="titulo">TRANSFERÊNCIA DE CALOR</div>
                        <a href="materias/transferencia-calor.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00195" data-requisitos='["TEM00194","1 periodo completo","2 periodo completo","3 periodo completo","4 periodo completo"]'>
                        <div class="titulo">MECÂNICA DOS SÓLIDOS II</div>
                        <a href="materias/mecanica-solidos2.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00199" data-requisitos='["TEM00194","TEM00209","1 periodo completo","2 periodo completo","3 periodo completo","4 periodo completo"]'>
                        <div class="titulo">VIBRAÇÕES E SISTEMAS MECÂNICOS</div>
                        <a href="materias/vibracoes.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00205" data-requisitos='["TEM00211","1 periodo completo","2 periodo completo","3 periodo completo","4 periodo completo"]'>
                        <div class="titulo">METROLOGIA INDUSTRIAL</div>
                        <a href="materias/metrologia.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00280" data-requisitos='["TEM00279","TEM00193","1 periodo completo","2 periodo completo","3 periodo completo","4 periodo completo"]'>
                        <div class="titulo">MÁQUINAS TÉRMICAS I</div>
                        <a href="materias/maquinas-termicas.html" class="btn">Acesse</a>
                    </div>
                    <div class="box-empty"></div>
                </div>

                <!-- ==================== COLUNA 7 (PERÍODO 7) ==================== -->
                <div class="coluna">
                    <div class="box" id="TEE00113" data-requisitos='["GET00177","GFI00159","GFI00162","GMA00162","TEM00187","TEM00190"]'>
                        <div class="titulo">ELETROTÉCNICA</div>
                        <a href="materias/eletrotecnica.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00047" data-requisitos='["TEM00189","TEM00211"]'>
                        <div class="titulo">USINAGEM</div>
                        <a href="materias/usinagem.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00051" data-requisitos='["TEM00189"]'>
                        <div class="titulo">ENGENHARIA DOS MATERIAIS II-A</div>
                        <a href="materias/materiais2.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00197" data-requisitos='["TEM00195"]'>
                        <div class="titulo">ELEMENTOS DE MÁQUINAS I</div>
                        <a href="materias/elementos-maquinas1.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00210" data-requisitos='["TEM00184"]'>
                        <div class="titulo">MÁQUINAS HIDRÁULICAS</div>
                        <a href="materias/maquinas-hidraulicas.html" class="btn">Acesse</a>
                    </div>
                    <div class="box-empty"></div>
                    <div class="box-empty"></div>
                </div>

                <!-- ==================== COLUNA 8 (PERÍODO 8) ==================== -->
                <div class="coluna">
                    <div class="box" id="TEM00198" data-requisitos='["TEM00051","TEM00197"]'>
                        <div class="titulo">ELEMENTOS DE MÁQUINAS II</div>
                        <a href="materias/elementos-maquinas2.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00203" data-requisitos='["TEM00211","TEM00051"]'>
                        <div class="titulo">FUNDIÇÃO E MANUFATURA ADITIVA</div>
                        <a href="materias/fundicao.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00204" data-requisitos='["TEM00211","TEM00051"]'>
                        <div class="titulo">SOLDAGEM E ENSAIOS</div>
                        <a href="materias/soldagem.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEP00108" data-requisitos='["1 periodo completo","2 periodo completo","3 periodo completo","4 periodo completo"]'>
                        <div class="titulo">ADMINISTRAÇÃO APLICADA</div>
                        <a href="materias/administracao.html" class="btn">Acesse</a>
                    </div>
                    <div class="box-empty"></div>
                    <div class="box-empty"></div>
                    <div class="box-empty"></div>
                </div>

                <!-- ==================== COLUNA 9 (PERÍODO 9) ==================== -->
                <div class="coluna">
                    <div class="box" id="TEM00212" data-requisitos='["1 periodo completo","2 periodo completo","3 periodo completo","4 periodo completo","5 periodo completo","6 periodo completo","7 periodo completo"]'>
                        <div class="titulo">PROJETO DE ENGENHARIA MECÂNICA I</div>
                        <a href="materias/projeto1.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEM00214" data-requisitos='["1 periodo completo","2 periodo completo","3 periodo completo","4 periodo completo","5 periodo completo","6 periodo completo"]'>
                        <div class="titulo">ESTÁGIO OBRIGATÓRIO</div>
                        <a href="materias/estagio.html" class="btn">Acesse</a>
                    </div>
                    <div class="box" id="TEP00109" data-requisitos='["1 periodo completo","2 periodo completo","3 periodo completo","4 periodo completo"]'>
                        <div class="titulo">ECONOMIA APLICADA</div>
                        <a href="materias/economia.html" class="btn">Acesse</a>
                    </div>
                    <div class="box-empty"></div>
                    <div class="box-empty"></div>
                    <div class="box-empty"></div>
                    <div class="box-empty"></div>
                </div>

                <!-- ==================== COLUNA 10 (PERÍODO 10) ==================== -->
                <div class="coluna">
                    <div class="box" id="TEM00213" data-requisitos='["TEM00212","1 periodo completo","2 periodo completo","3 periodo completo","4 periodo completo","5 periodo completo","6 periodo completo","7 periodo completo"]'>
                        <div class="titulo">PROJETO DE ENGENHARIA MECÂNICA II</div>
                        <a href="materias/projeto2.html" class="btn">Acesse</a>
                    </div>
                    <div class="box-empty"></div>
                    <div class="box-empty"></div>
                    <div class="box-empty"></div>
                    <div class="box-empty"></div>
                    <div class="box-empty"></div>
                    <div class="box-empty"></div>
                </div>
            </div>
        </main>

        <footer>
            <div id="direitos">
                <h4>Todos os direitos reservados / PETMEC / Universidade Federal Fluminense</h4>
            </div>
        </footer>
    </div>
</body>
</html>

<script>
    var app = new Framework7({
    panel: {
        swipe: 'left'
    }
    });
</script>


<?php

?>