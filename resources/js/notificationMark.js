document.addEventListener('DOMContentLoaded', function() {
    // Charger le compteur de notifications non lues
    fetch('/notifications-count')
        .then(response => response.json())
        .then(data => {
            const badge = document.getElementById('notification-badge');
            if (data.unreadCount > 0) {
                badge.textContent = data.unreadCount;
                badge.classList.add('show');
            } else {
                badge.classList.remove('show');
            }
        });
});