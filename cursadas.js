// Estado para controle de matérias cursadas
const materiasCursadas = {
    cursadas: [],
    
    carregar: function() {
        const salvo = localStorage.getItem('materiasCursadas');
        if (salvo) {
            this.cursadas = JSON.parse(salvo);
        }
    },
    
    salvar: function() {
        localStorage.setItem('materiasCursadas', JSON.stringify(this.cursadas));
    },
    
    alternar: function(codigoMateria) {
        const index = this.cursadas.indexOf(codigoMateria);
        if (index === -1) {
            this.cursadas.push(codigoMateria);
        } else {
            this.cursadas.splice(index, 1);
        }
        this.salvar();
    },
    
    verificarRequisitos: function(codigoMateria) {
        const materia = estadoApp.dadosMaterias[codigoMateria];
        if (!materia || !materia.requisitos || materia.requisitos.length === 0) {
            return { cumprido: true, faltantes: [] };
        }
        
        const requisitosFaltantes = materia.requisitos.filter(
            requisito => !this.cursadas.includes(requisito)
        );
        
        return {
            cumprido: requisitosFaltantes.length === 0,
            faltantes: requisitosFaltantes
        };
    },
    
    aplicarEstiloFaltando: function(elemento, requisitosFaltantes) {
        elemento.style.boxShadow = '0px 0px 15px 5px #FF0000';
        elemento.style.opacity = '0.7';
        elemento.style.cursor = 'not-allowed';
        const faltantesStr = requisitosFaltantes.join(', ');
        elemento.title = `Pré-requisitos não cumpridos: ${faltantesStr}`;
    }
};

// Função para inicializar o módulo de matérias cursadas
function inicializarMateriasCursadas() {
    materiasCursadas.carregar();
    
    document.querySelectorAll('.box').forEach(elemento => {
        elemento.addEventListener('click', function() {
            materiasCursadas.alternar(this.id);
            // Aqui você pode adicionar lógica para atualizar a interface
        });
    });
}

// Exportação para uso em outros arquivos (se necessário)
if (typeof module !== 'undefined' && module.exports) {
    module.exports = materiasCursadas;
}