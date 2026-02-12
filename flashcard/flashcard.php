<?php
    // =========================================================
    // 1. CONFIGURAÇÕES E SEGURANÇA
    // =========================================================
    
    // Conecta com a verificação de login (volta uma pasta ../)
    include("../login-pages/protect.php");
    // Conecta com o banco de dados
    include("../login-pages/database.php");

    // =========================================================
    // 2. BUSCAR MATÉRIAS CURSADAS NO BANCO DE DADOS
    // =========================================================
    
    $email_usuario = $_SESSION['email'];
    $materias_cursadas = []; // Array vazio para começar

    // Prepara a consulta SQL segura
    $sql = "SELECT cursadas FROM progresso WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($linha = $resultado->fetch_assoc()) {
        // Transforma a string "MAT1,MAT2,MAT3" em um Array ["MAT1", "MAT2", "MAT3"]
        // Se o campo estiver vazio, cria um array vazio
        if (!empty($linha['cursadas'])) {
            $materias_cursadas = explode(",", $linha['cursadas']);
        }
    }
    $stmt->close();

    // =========================================================
    // 3. CARREGAR E FILTRAR OS FLASHCARDS
    // =========================================================

    // Carrega o arquivo JSON
    $arquivo_json = 'flashcard.json';
    $cards_para_exibir = [];

    if (file_exists($arquivo_json)) {
        $conteudo_json = file_get_contents($arquivo_json);
        $todos_cards = json_decode($conteudo_json, true);

        if ($todos_cards) {
            foreach ($todos_cards as $card) {
                // LÓGICA DO FILTRO:
                // Só adiciona o card se o código dele estiver na lista de matérias cursadas
                if (isset($card['codigo']) && in_array($card['codigo'], $materias_cursadas)) {
                    $cards_para_exibir[] = $card;
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Flashcards - Hiperfluxo</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* ================= ESTILOS (CSS) ================= */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        
        body {
            background-color: #f0f2f5;
            height: 100vh;
            overflow: hidden; /* Impede rolagem da tela */
            display: flex;
            flex-direction: column;
        }

        /* HEADER */
        header {
            background-color: #161616;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            z-index: 100;
        }

        .logo h1 { color: white; font-size: 1.2rem; font-weight: 700; }
        .logo span { color: #48A1D9; }

        .btn-voltar {
            background: #333;
            color: white;
            padding: 8px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: 0.3s;
            border: 1px solid #444;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .btn-voltar:hover { background: #48A1D9; border-color: #48A1D9; }

        /* ÁREA PRINCIPAL DOS CARDS */
        .container-estudo {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            width: 100%;
            padding: 20px;
        }

        .stack {
            position: relative;
            width: 100%;
            max-width: 380px;
            height: 550px;
            max-height: 80vh;
        }

        /* ESTILO DO CARD */
        .card {
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            border-radius: 20px;
            background: white;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            cursor: grab;
            perspective: 1000px;
            user-select: none;
            transform-origin: 50% 100%; /* Pivô embaixo para rotação natural */
        }
        .card:active { cursor: grabbing; }

        /* ANIMAÇÃO DE VIRAR (FLIP) */
        .card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transform-style: preserve-3d;
            border-radius: 20px;
        }

        .card.flipped .card-inner {
            transform: rotateY(180deg);
        }

        .face {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden; /* Esconde o verso */
            border-radius: 20px;
            padding: 25px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: white;
            border: 1px solid #e2e8f0;
        }

        .face.back {
            transform: rotateY(180deg);
            background: #f8fafc;
            border: 2px solid #48A1D9;
        }

        /* CONTEÚDO DO CARD */
        .tag-materia {
            align-self: center;
            background: #e0f2fe;
            color: #0369a1;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .imagem-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 15px 0;
            background: #f1f5f9;
            border-radius: 12px;
            overflow: hidden;
        }

        .imagem-pergunta {
            max-width: 100%;
            max-height: 200px;
            object-fit: contain;
        }

        .texto-conteudo {
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            line-height: 1.5;
            color: #1e293b;
            font-weight: 500;
        }

        .instrucao {
            font-size: 0.8rem;
            color: #94a3b8;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        /* BADGES (FÁCIL / DIFÍCIL) */
        .badge {
            position: absolute;
            top: 40px;
            padding: 8px 20px;
            border: 4px solid;
            border-radius: 10px;
            font-size: 1.8rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            opacity: 0;
            z-index: 10;
        }

        .badge-nope {
            right: 30px;
            color: #ef4444;
            border-color: #ef4444;
            transform: rotate(15deg);
        }

        .badge-like {
            left: 30px;
            color: #22c55e;
            border-color: #22c55e;
            transform: rotate(-15deg);
        }

        /* BOTÕES DE CONTROLE */
        .controles {
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 25px;
            padding-bottom: 20px;
        }

        .btn-circle {
            width: 65px; height: 65px;
            border-radius: 50%;
            border: none;
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            font-size: 1.5rem;
            cursor: pointer;
            transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-circle:active { transform: scale(0.9); }
        .btn-x { color: #ef4444; }
        .btn-flip { color: #48A1D9; font-size: 1.2rem; background: #f0f9ff; }
        .btn-heart { color: #22c55e; }

        /* MENSAGEM DE FIM/VAZIO */
        .msg-centro {
            position: absolute;
            text-align: center;
            z-index: 0;
            color: #64748b;
            padding: 20px;
            width: 100%;
            
            /* ADICIONE ESSAS LINHAS: */
            opacity: 0;             /* Torna invisível */
            transition: opacity 0.5s ease; /* Animação suave quando aparecer */
            pointer-events: none;   /* Impede clicar no botão enquanto invisível */
        }
        .msg-centro i { color: #cbd5e1; margin-bottom: 15px; }
        .msg-centro h3 { margin-bottom: 10px; color: #334155; }
    </style>
</head>
<body>

    <header>
        <div class="logo">
            <h1><span>HIPER</span>FLUXO</h1>
        </div>
        <a href="../home.php" class="btn-voltar">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </header>

    <div class="container-estudo">
        
        <div class="msg-centro">
            <i class="fas fa-check-circle fa-4x"></i>
            <h3>Você finalizou!</h3>
            <p>Não há mais cards disponíveis para as matérias que você cursou.</p>
            <br>
            <button class="btn-voltar" onclick="location.reload()" style="margin: 0 auto; background: #48A1D9; border: none;">
                Recomeçar
            </button>
        </div>

        <div class="stack" id="pilha">
            <?php if (empty($cards_para_exibir)): ?>
                <div class="card">
                    <div class="card-inner">
                        <div class="face front" style="justify-content: center; text-align: center;">
                            <i class="fas fa-graduation-cap fa-4x" style="color: #cbd5e1; margin-bottom: 20px;"></i>
                            <h3 style="color: #334155;">Nenhum Card Disponível</h3>
                            <p style="color: #64748b; margin-top: 10px; font-size: 0.9rem;">
                                Parece que você ainda não cursou as matérias que possuem flashcards cadastrados.
                            </p>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach(array_reverse($cards_para_exibir) as $card): ?>
                    <div class="card">
                        <div class="card-inner">
                            
                            <div class="face front">
                                <span class="tag-materia"><?php echo $card['materia']; ?></span>
                                
                                <div class="imagem-container">
                                    <?php if(!empty($card['imagem'])): ?>
                                        <img src="<?php echo $card['imagem']; ?>" class="imagem-pergunta" alt="Imagem da questão">
                                    <?php else: ?>
                                        <i class="fas fa-image fa-3x" style="color:#cbd5e1;"></i>
                                    <?php endif; ?>
                                </div>

                                <div class="texto-conteudo">
                                    <?php echo $card['pergunta']; ?>
                                </div>

                                <div class="badge badge-like">FÁCIL</div>
                                <div class="badge badge-nope">DIFÍCIL</div>
                                
                                <div class="instrucao">
                                    <i class="fas fa-hand-pointer"></i> Toque para ver a resposta
                                </div>
                            </div>

                            <div class="face back">
                                <span class="tag-materia">Resposta</span>
                                
                                <div class="texto-conteudo" style="flex: 1;">
                                    <?php echo $card['resposta']; ?>
                                </div>

                                <div class="instrucao">
                                    <i class="fas fa-arrow-left"></i> Difícil &nbsp;|&nbsp; Fácil <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="controles">
        <button class="btn-circle btn-x" onclick="acaoBotao('esquerda')">
            <i class="fas fa-times"></i>
        </button>
        <button class="btn-circle btn-flip" onclick="acaoVirar()">
            <i class="fas fa-sync-alt"></i>
        </button>
        <button class="btn-circle btn-heart" onclick="acaoBotao('direita')">
            <i class="fas fa-heart"></i>
        </button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => configurarCard(card));
        });

        function configurarCard(card) {
            let isArrastando = false;
            let inicioX = 0;
            let atualX = 0;
            const badgeLike = card.querySelector('.badge-like');
            const badgeNope = card.querySelector('.badge-nope');

            // Funções de início, movimento e fim
            const iniciar = (e) => {
                isArrastando = true;
                inicioX = e.type.includes('mouse') ? e.clientX : e.touches[0].clientX;
                card.style.transition = 'none'; // Remove delay para seguir o dedo instantaneamente
            };

            const mover = (e) => {
                if (!isArrastando) return;
                
                // Pega posição X atual
                let clienteX = e.type.includes('mouse') ? e.clientX : e.touches[0].clientX;
                atualX = clienteX - inicioX;
                
                // Calcula rotação baseada na distância
                let rotacao = atualX * 0.05;

                // Aplica movimento CSS
                card.style.transform = `translateX(${atualX}px) rotate(${rotacao}deg)`;

                // Controla opacidade dos carimbos (Badges)
                if (badgeLike && badgeNope) {
                    const opacidade = Math.min(Math.abs(atualX) / 100, 1);
                    if (atualX > 0) {
                        badgeLike.style.opacity = opacidade;
                        badgeNope.style.opacity = 0;
                    } else {
                        badgeNope.style.opacity = opacidade;
                        badgeLike.style.opacity = 0;
                    }
                }
            };

            const finalizar = () => {
                if (!isArrastando) return;
                isArrastando = false;
                card.style.transition = 'transform 0.5s ease'; // Restaura animação suave

                const limiteParaSwipe = 100; // Pixels necessários para considerar swipe

                if (atualX > limiteParaSwipe) {
                    jogarFora(card, 'direita');
                } else if (atualX < -limiteParaSwipe) {
                    jogarFora(card, 'esquerda');
                } else {
                    // Se não arrastou o suficiente, volta pro meio
                    card.style.transform = 'translateX(0) rotate(0)';
                    if(badgeLike) badgeLike.style.opacity = 0;
                    if(badgeNope) badgeNope.style.opacity = 0;
                }
                atualX = 0;
            };

            // Event Listeners (Mouse e Touch)
            card.addEventListener('mousedown', iniciar);
            card.addEventListener('touchstart', iniciar);

            window.addEventListener('mousemove', mover); // Window para não perder o foco se sair do card
            window.addEventListener('touchmove', mover);

            window.addEventListener('mouseup', finalizar);
            window.addEventListener('touchend', finalizar);

            // Clique simples para virar
            card.addEventListener('click', (e) => {
                // Só vira se não estiver arrastando
                if (Math.abs(atualX) < 5) {
                    card.classList.toggle('flipped');
                }
            });
        }

        // Função para animar a saída do card
        function jogarFora(card, direcao) {
            const distanciaX = direcao === 'direita' ? 1000 : -1000;
            const rotacaoFinal = direcao === 'direita' ? 30 : -30;

            card.style.transform = `translateX(${distanciaX}px) rotate(${rotacaoFinal}deg)`;

            // Remove do HTML após a animação terminar
            setTimeout(() => {
                card.remove();

                // --- NOVA PARTE: VERIFICA SE ACABARAM AS CARTAS ---
                const cartasRestantes = document.querySelectorAll('.card');

                if (cartasRestantes.length === 0) {
                    const msgFinal = document.querySelector('.msg-centro');
                    msgFinal.style.opacity = '1';           // Torna visível
                    msgFinal.style.zIndex = '10';           // Traz para frente
                    msgFinal.style.pointerEvents = 'auto';  // Permite clicar no botão
                }
                // --------------------------------------------------

            }, 400);
        }

        // Funções para os botões da interface
        function acaoBotao(direcao) {
            const cardsDisponiveis = document.querySelectorAll('.card');
            if (cardsDisponiveis.length === 0) return;

            // Pega o último card da lista (o que está no topo visualmente)
            const cardTopo = cardsDisponiveis[cardsDisponiveis.length - 1];
            
            // Mostra o badge para feedback visual
            const badge = cardTopo.querySelector(direcao === 'direita' ? '.badge-like' : '.badge-nope');
            if(badge) {
                badge.style.opacity = 1;
                badge.style.transition = 'opacity 0.2s';
            }

            jogarFora(cardTopo, direcao);
        }

        function acaoVirar() {
            const cardsDisponiveis = document.querySelectorAll('.card');
            if (cardsDisponiveis.length === 0) return;
            
            const cardTopo = cardsDisponiveis[cardsDisponiveis.length - 1];
            cardTopo.classList.toggle('flipped');
        }
    </script>
</body>
</html>