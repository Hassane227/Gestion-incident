document.addEventListener('DOMContentLoaded', function() {
    const burgerMenu = document.querySelector('.burger-menu');
    const navLinks = document.querySelector('.nav-links');

    burgerMenu.addEventListener('click', function() {
        navLinks.classList.toggle('show');
    });
});


    // Liste des images
const images = document.querySelectorAll('#image-container img');

// Index de l'image actuellement affichée
let currentIndex = 0;

// Fonction pour changer l'image affichée
function changeImage() {
    // Masquer toutes les images
    images.forEach(img => img.style.display = 'none');
    // Afficher l'image suivante
    currentIndex = (currentIndex + 1) % images.length;
    images[currentIndex].style.display = 'block';
}

// Appeler la fonction changeImage toutes les 3 secondes (3000 millisecondes)
setInterval(changeImage, 3000);

