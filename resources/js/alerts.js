setTimeout(() => {
    let alert = document.querySelector('.alert');
    if (alert) {
        alert.style.transition = 'opacity 0.5s ease-out'; 
        alert.style.opacity = 0;
        setTimeout(() => {
            alert.style.display = 'none'; 
            window.location.reload();
        }, 500); 
    }
}, 500);
