document.addEventListener('DOMContentLoaded', function () {
    const materialSelect = document.getElementById('material-select');
    const items = document.querySelectorAll('.item');

    materialSelect.addEventListener('change', function () {
        const selectedMaterial = materialSelect.value;

        items.forEach(item => {
            const material = item.dataset.material;

            if (selectedMaterial === 'todos' || selectedMaterial === material) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});
