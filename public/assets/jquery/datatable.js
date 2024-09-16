$(document).ready(function() {
    $('#table').DataTable({
        "columnDefs": [
            {
                "targets": 1,  // Alvo da coluna (0-indexada)
                "className": "text-start"  // Classe CSS para alinhar o texto à direita
            }
        ],

        "language": {
            "url": 'http://localhost/ci4_biblioteca/public/assets/js/pt-BR.json'  // Use o base URL para o caminho do JSON
        }
        
    });
    
    
});