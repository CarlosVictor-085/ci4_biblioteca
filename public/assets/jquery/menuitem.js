document.addEventListener('DOMContentLoaded', function () {
    // Function to handle the click event on menu links
    function handleMenuItemClick(event) {
        event.preventDefault(); // Prevent the default link behavior

        // Get the clicked menu link
        const menuLink = event.currentTarget;
        const menuItem = menuLink.closest('.menu-item');
        
        // Remove 'active' class from all menu items
        document.querySelectorAll('.menu-item').forEach(item => {
            item.classList.remove('active');
        });

        // Add 'active' class to the clicked menu item's <li>
        if (menuItem) {
            menuItem.classList.add('active');
            // Store the active item's URL in localStorage
            localStorage.setItem('activeMenuItem', menuLink.getAttribute('href'));
        }

        // Navigate to the link after setting the active state
        setTimeout(() => {
            window.location.href = menuLink.getAttribute('href');
        }, 100); // Small delay to ensure class update
    }

    // Function to set the active item on page load
    function setActiveMenuItem() {
        const activeItemUrl = localStorage.getItem('activeMenuItem');
        if (activeItemUrl) {
            document.querySelectorAll('.menu-link').forEach(link => {
                if (link.getAttribute('href') === activeItemUrl) {
                    link.closest('.menu-item').classList.add('active');
                }
            });
        }
    }

    // Attach click event listeners to all menu links
    document.querySelectorAll('.menu-link').forEach(link => {
        link.addEventListener('click', handleMenuItemClick);
    });

    // Set the active item on page load
    setActiveMenuItem();
});
