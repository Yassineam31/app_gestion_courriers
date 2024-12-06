
function toggleSidebar() {
    var sidebar = document.getElementById('sidebar');
    var content = document.getElementById('mainContent');
    content.style.transition = 'margin-left 0.3s';
    sidebar.classList.toggle('closed');
    content.classList.toggle('closed');
}

function closeSidebar() {
    var sidebar = document.getElementById('sidebar');
    var content = document.getElementById('mainContent');
    content.style.transition = 'margin-left 0.3s ';
    sidebar.classList.add('closed');
    content.classList.add('closed');
}

document.getElementById('toggleSidebar').addEventListener('click', toggleSidebar);
document.getElementById('closeSidebar').addEventListener('click', closeSidebar);

    
