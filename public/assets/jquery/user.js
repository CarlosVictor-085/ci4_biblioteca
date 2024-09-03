document.addEventListener('DOMContentLoaded', function () {
    // Function to handle the click event on the link
    function handleLinkClick(event) {
        // Prevent the default link behavior
        event.preventDefault();

        // Get the clicked link
        const link = event.currentTarget;

        // Add the 'show' class to the link
        link.classList.add('show');

        // Remove the 'show' class after a short delay
        setTimeout(() => {
            link.classList.remove('show');
        }, 1000); // Delay in milliseconds (e.g., 1000ms = 1 second)
    }

    // Attach click event listeners to all links with the class 'nav-link'
    document.querySelectorAll('.nav-link.dropdown-toggle').forEach(link => {
        link.addEventListener('click', handleLinkClick);
    });
});
