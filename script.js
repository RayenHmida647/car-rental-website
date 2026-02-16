// Active nav link
document.addEventListener('DOMContentLoaded', function() {
    const currentLocation = window.location.pathname;
    const navLinks = document.querySelectorAll('nav a');
    
    navLinks.forEach(link => {
        const linkPath = link.getAttribute('href');
        if(currentLocation.includes(linkPath) && linkPath !== '#') {
            link.classList.add('active');
        }
    });
});

// Date validation
document.addEventListener('DOMContentLoaded', function() {
    const startDate = document.querySelector('input[name="start_date"]');
    const endDate = document.querySelector('input[name="end_date"]');
    
    if(startDate && endDate) {
        startDate.addEventListener('change', function() {
            endDate.min = this.value;
            if(endDate.value && endDate.value < this.value) {
                endDate.value = this.value;
            }
        });
    }
});

// Confirmation dialogs
function confirmBooking() {
    return confirm('Confirm your reservation?');
}

function confirmDelete() {
    return confirm('Are you sure? This action cannot be undone.');
}

// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});