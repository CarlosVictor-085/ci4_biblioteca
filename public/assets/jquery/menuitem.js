document.addEventListener('DOMContentLoaded', () => {
    const menuItems = document.querySelectorAll('.menu-item');

    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            // Adiciona a classe 'active' ao item clicado
            this.classList.add('active');
        });
    });
});