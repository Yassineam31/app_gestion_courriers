setTimeout(() => {
    let alert = document.querySelector('.alert');
    if (alert) {
        alert.style.transition = 'opacity 0.5s ease-out'; // Ajoute une transition pour l'opacité
        alert.style.opacity = 0; // Débute la disparition progressive
        setTimeout(() => {
            alert.style.display = 'none'; // Cache complètement après la transition
        }, 500); // Délai correspondant à la durée de la transition
    }
}, 500); // Délai initial avant de commencer la transition
