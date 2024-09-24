document.addEventListener('DOMContentLoaded', function () {
    // Seleciona o link e o menu dropdown
    const dropdownLink = document.querySelector('.nav-link.dropdown-toggle.hide-arrow');
    const dropdownMenu = document.querySelector('.dropdown-menu.dropdown-menu-end');

    if (dropdownLink && dropdownMenu) {
        dropdownLink.addEventListener('click', function (event) {
            event.preventDefault(); // Impede o comportamento padrão
            
            // Verifica se o dropdown já está expandido
            const isExpanded = dropdownLink.classList.contains('show');

            if (isExpanded) {
                // Fecha o dropdown
                dropdownLink.setAttribute('aria-expanded', 'false');
                dropdownLink.classList.remove('show');
                dropdownMenu.classList.remove('show');
            } else {
                // Abre o dropdown
                dropdownLink.setAttribute('aria-expanded', 'true');
                dropdownLink.classList.add('show');
                dropdownMenu.classList.add('show');
                dropdownMenu.removeAttribute('data-bs-popper');
            }

            // Log para verificar se a alternância está funcionando
            console.log(`Dropdown está ${isExpanded ? 'fechado' : 'aberto'}`);
        });
    } else {
        console.error('O link ou o menu dropdown não foi encontrado no DOM.');
    }
});
