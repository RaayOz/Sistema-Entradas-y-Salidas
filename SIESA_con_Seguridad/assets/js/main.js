document.getElementById('toggle-btn').addEventListener('click', function() {
    // Seleccionamos el sidebar y el contenedor
    const sidebar = document.querySelector('.sidebar');
    const container = document.querySelector('.container');

    // Alternamos las clases
    sidebar.classList.toggle('minimized');
    container.classList.toggle('expanded');
});