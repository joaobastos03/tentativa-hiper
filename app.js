// Configurações completas de estilo para cada cor disponível
console.log("oi")

const estilosPorCor = {
    verde: {
        background: 'linear-gradient(#1CA64C, #148C3E, #034018)',
        border: '1px solid #1CA64C',
        boxShadowHighlight: '0px 0px 50px 25px #1CA64C',
        backgroundColorNormal: '#7AD3A6'
    },
    azul: {
        background: 'linear-gradient(#64dce7, #6674DE)',
        border: '1px solid #64dce7',
        boxShadowHighlight: '0px 0px 50px 25px #64dce7',
        backgroundColorNormal: '#48A1D9'
    },
    marrom: {
        background: 'linear-gradient(#98684A, #9B5D46, #422E2D)',
        border: '1px solid #98684A',
        boxShadowHighlight: '0px 0px 50px 25px #6b3a15',
        backgroundColorNormal: '#98684A'
    },
    vermelho: {
        background: 'linear-gradient(#f8881f, #E06D00, #E0000D)',
        border: '1px solid #E06D00',
        boxShadowHighlight: '0px 0px 50px 25px #E06D00',
        backgroundColorNormal: '#F5726F'
    },
    rosa: {
        background: 'linear-gradient(#360DFF, #6D0CE8, #B400FE, #E60CE8, #FF0D8B)',
        border: '1px solid #CD9DFF',
        boxShadowHighlight: '0px 0px 50px 25px #de5dde',
        backgroundColorNormal: '#CD9DFF'
    },
    roxo: {
        background: 'linear-gradient(#FE3574, #FF6C5A)',
        border: '1px solid #FE3574',
        boxShadowHighlight: '0px 0px 50px 25px #FE3574',
        backgroundColorNormal: '#6F71E8'
    },
    cinza: {
        background: 'linear-gradient(#A6A6A6, #595959, #262626)',
        border: '1px solid #A6A6A6',
        boxShadowHighlight: '0px 0px 50px 25px #737372',
        backgroundColorNormal: '#737372'
    },
    laranja: {
        background: 'linear-gradient(#F2CE1B, #F27B50)',
        border: '1px solid #F2CE1B',
        boxShadowHighlight: '0px 0px 50px 25px #F2CE1B',
        backgroundColorNormal: '#F2913D'
    }
};

// Estado global da aplicação
const estadoApp = {
    dadosMaterias: {},
    coresAgrupadas: {},
    materiasSelecionadas: []
};

// Função para carregar o arquivo JSON
function carregarDadosJSON() {
    return fetch('obrigatorias.json')
        .then(resposta => {
            if (!resposta.ok) {
                throw new Error('Erro ao carregar o arquivo JSON');
            }
            return resposta.json();
        })
        .then(dados => {
            estadoApp.dadosMaterias = dados;
            return dados;
        });
}

// Função para aplicar estilos dinâmicos
function aplicarEstilosDinamicos(dadosJSON) {
    const coresAgrupadas = {};
    
    Object.keys(estilosPorCor).forEach(cor => {
        coresAgrupadas[cor] = [];
    });

    for (const codigoMateria in dadosJSON) {
        if (dadosJSON.hasOwnProperty(codigoMateria)) {
            const materia = dadosJSON[codigoMateria];
            const corMateria = materia.cor;
            
            if (corMateria && coresAgrupadas[corMateria] !== undefined) {
                coresAgrupadas[corMateria].push(codigoMateria);
                
                const elementoMateria = document.getElementById(codigoMateria);
                if (elementoMateria) {
                    elementoMateria.style.background = estilosPorCor[corMateria].background;
                    elementoMateria.style.border = estilosPorCor[corMateria].border;
                    
                    // Adiciona atributo data-requisitos apenas se houver requisitos
                    if (materia.requisitos && materia.requisitos.length > 0) {
                        elementoMateria.setAttribute('data-requisitos', JSON.stringify(materia.requisitos));
                    } else {
                        elementoMateria.removeAttribute('data-requisitos');
                    }
                    
                    // Adiciona tooltip com informações básicas
                    const tooltipText = `${materia.titulo}\nPeríodo: ${materia.periodo}\nCarga Horária: ${materia.horas}h`;
                    elementoMateria.setAttribute('data-tooltip', tooltipText);
                }
            }
        }
    }

    return coresAgrupadas;
}

// Função para destacar requisitos e elemento com hover
function alterarRequisito(idsRequisitos, elementoHover) {
    const todosElementos = document.querySelectorAll('.box');
    
    todosElementos.forEach(elemento => {
        const isRequisito = idsRequisitos.includes(elemento.id);
        const isHovered = elemento.id === elementoHover.id;
        const corElemento = encontrarCorDoElemento(elemento.id);
        
        if (isRequisito || isHovered) {
            if (corElemento) {
                elemento.style.transform = 'translateY(-20%)';
                elemento.style.boxShadow = estilosPorCor[corElemento].boxShadowHighlight;
                elemento.style.zIndex = '5';
                
                if (isHovered) {
                    elemento.style.boxShadow = `
                        0 0 20px 10px ${estilosPorCor[corElemento].backgroundColorNormal},
                        ${estilosPorCor[corElemento].boxShadowHighlight}
                    `;
                    elemento.style.zIndex = '10';
                    elemento.style.transform = 'translateY(-20%) scale(1.05)';
                }
            }
        } else {
            elemento.style.filter = 'blur(15px) grayscale(80%)';
            elemento.style.zIndex = '1';
        }
    });
}

// Função para restaurar o estado normal dos elementos
function restaurarRequisitos() {
    const todosElementos = document.querySelectorAll('.box');
    
    todosElementos.forEach(elemento => {
        const corElemento = encontrarCorDoElemento(elemento.id);
        if (corElemento) {
            elemento.style.background = estilosPorCor[corElemento].background;
            elemento.style.border = estilosPorCor[corElemento].border;
            elemento.style.filter = 'none';
            elemento.style.transform = 'none';
            elemento.style.boxShadow = 'none';
            elemento.style.zIndex = '1';
        }
    });
}

// Função auxiliar para encontrar a cor de um elemento
function encontrarCorDoElemento(idElemento) {
    for (const cor in estadoApp.coresAgrupadas) {
        if (estadoApp.coresAgrupadas[cor].includes(idElemento)) {
            return cor;
        }
    }
    return null;
}

// Função para inicializar tooltips
function inicializarTooltips() {
    const tooltips = document.querySelectorAll('[data-tooltip]');
    tooltips.forEach(elemento => {
        elemento.addEventListener('mouseenter', (e) => {
            const tooltip = document.createElement('div');
            tooltip.className = 'custom-tooltip';
            tooltip.textContent = e.target.getAttribute('data-tooltip');
            
            document.body.appendChild(tooltip);
            
            const updatePosition = () => {
                const rect = e.target.getBoundingClientRect();
                tooltip.style.left = `${rect.left + window.scrollX}px`;
                tooltip.style.top = `${rect.top + window.scrollY - tooltip.offsetHeight - 10}px`;
            };
            
            updatePosition();
            window.addEventListener('scroll', updatePosition);
            
            elemento._tooltip = {
                element: tooltip,
                updatePosition
            };
        });
        
        elemento.addEventListener('mouseleave', () => {
            if (elemento._tooltip) {
                document.body.removeChild(elemento._tooltip.element);
                window.removeEventListener('scroll', elemento._tooltip.updatePosition);
                delete elemento._tooltip;
            }
        });
    });
}

// Função para criar e gerenciar o ponteiro de informações
//function inicializarPonteiroInformacao() {
//    const ponteiro = document.createElement('div');
//    ponteiro.id = 'info-ponteiro';
//    document.body.appendChild(ponteiro);
//
//    document.querySelectorAll('.box').forEach(box => {
//        const codigoMateria = box.id;
//        const materia = estadoApp.dadosMaterias[codigoMateria];
//        
//        if (materia) {
//            box.addEventListener('mousemove', (e) => {
//                ponteiro.style.display = 'block';
//                ponteiro.textContent = `Período: ${materia.periodo} | Carga Horária: ${materia.horas}h`;
//                ponteiro.style.left = `${e.pageX + 15}px`;
//                ponteiro.style.top = `${e.pageY + 15}px`;
//            });
//
//            box.addEventListener('mouseleave', () => {
//                ponteiro.style.display = 'none';
//            });
//        }
//    });
//}


// Função principal que inicializa a aplicação

function checkOrientation() {
    const warning = document.querySelector('.orientation-warning');
    const isMobile = window.matchMedia("(max-width: 768px)").matches;
    
    if (isMobile && window.innerHeight > window.innerWidth) {
        warning.classList.add('show');
    } else {
        warning.classList.remove('show');
    }
}


function inicializarAplicacao() {
    carregarDadosJSON()
        .then(dadosJSON => {
            estadoApp.coresAgrupadas = aplicarEstilosDinamicos(dadosJSON);
            inicializarTooltips();
            //inicializarPonteiroInformacao();
            
            const todosElementos = document.querySelectorAll('.box');
            todosElementos.forEach(elemento => {
                elemento.addEventListener('mouseover', function() {
                    const requisitos = this.getAttribute('data-requisitos');
                    if (requisitos) {
                        alterarRequisito(JSON.parse(requisitos), this);
                    }
                });
                
                elemento.addEventListener('mouseout', restaurarRequisitos);
                
                elemento.addEventListener('click', function() {
                    // Seleção múltipla com Ctrl/Command
                    if (event.ctrlKey || event.metaKey) {
                        const index = estadoApp.materiasSelecionadas.indexOf(this.id);
                        if (index === -1) {
                            estadoApp.materiasSelecionadas.push(this.id);
                        } else {
                            estadoApp.materiasSelecionadas.splice(index, 1);
                        }
                        this.classList.toggle('selecionada');
                    }
                });
            });
            
            console.log('Aplicação inicializada com sucesso!');
        })
        .catch(erro => {
            console.error('Falha ao inicializar a aplicação:', erro);
        });
}

// Adiciona estilos CSS dinamicamente
const style = document.createElement('style');
style.textContent = `
    .custom-tooltip {
        position: absolute;
        background-color: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 8px 12px;
        border-radius: 4px;
        font-size: 14px;
        white-space: pre-line;
        z-index: 1000;
        pointer-events: none;
        max-width: 300px;
    }
    
    .box {
        transition: all 0.3s ease;
        cursor: pointer;
        transform-origin: center bottom;
    }
    
    .box[data-requisitos] {
        cursor: help;
    }
    
    #info-ponteiro {
        position: absolute;
        background-color: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 8px 12px;
        border-radius: 4px;
        font-size: 14px;
        white-space: nowrap;
        z-index: 1001;
        pointer-events: none;
        display: none;
    }
    
    .selecionada {
        box-shadow: 0 0 0 3px rgba(255,255,255,0.8) !important;
    }
`;
document.head.appendChild(style);

// Inicia a aplicação quando o DOM estiver totalmente carregado
document.addEventListener('DOMContentLoaded', inicializarAplicacao);
//window.addEventListener('load', checkOrientation);
//window.addEventListener('resize', checkOrientation);
//window.addEventListener('orientationchange', checkOrientation);