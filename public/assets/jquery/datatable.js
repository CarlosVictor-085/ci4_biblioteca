$(document).ready(function() {
    $('#table').DataTable({
        "columnDefs": [
            {
                "targets": 1,  // Alvo da coluna (0-indexada)
                "className": "text-start"  // Classe CSS para alinhar o texto à direita
            }
        ],

        "language": {
            "url": '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json'  // Use o base URL para o caminho do JSON
        }
        
    });
    
    
});