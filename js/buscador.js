document.getElementById('search-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita que se envíe el formulario de manera convencional
    const searchTerm = document.getElementById('search-input').value.toLowerCase(); // Obtiene el valor del campo de búsqueda en minúsculas
    const items = document.querySelectorAll('.item'); // Obtiene todos los elementos con clase 'item'

    items.forEach(function(item) {
        const title = item.querySelector('.item-desc-title').textContent.toLowerCase(); // Obtiene el texto del título en minúsculas
        if (title.includes(searchTerm)) {
            item.style.display = 'block'; // Muestra el elemento si el término de búsqueda está contenido en el título
        } else {
            item.style.display = 'none'; // Oculta el elemento si el término de búsqueda no está contenido en el título
        }
    });
});