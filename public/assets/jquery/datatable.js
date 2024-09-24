$(document).ready(function() {
    $('#table').DataTable({
        "columnDefs": [
            {
                "targets": 1,  // Alvo da coluna (0-indexada)
                "className": "text-start"  // Classe CSS para alinhar o texto à esquerda
            }
        ],

        "language": {
            "url": baseUrl2 + 'assets/js/pt-BR.json'  // Usa a URL base
        }
    });
});