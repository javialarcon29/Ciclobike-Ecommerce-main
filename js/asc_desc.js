document.addEventListener('DOMContentLoaded', function() {
    const sortSelect = document.getElementById('sort-select');
    const productsContainer = document.getElementById('product-container');

    sortSelect.addEventListener('change', function() {
        const selectedOption = sortSelect.value;

        const products = Array.from(productsContainer.querySelectorAll('.item'));

        products.sort(function(a, b) {
            const priceA = parseFloat(a.querySelector('.item-desc-price').textContent.replace(/[^\d.-]/g, ''));
            const priceB = parseFloat(b.querySelector('.item-desc-price').textContent.replace(/[^\d.-]/g, ''));

            if (selectedOption === 'asc') {
                return priceA - priceB;
            } else if (selectedOption === 'desc') {
                return priceB - priceA;
            }
        });

        productsContainer.innerHTML = '';
        products.forEach(function(product) {
            productsContainer.appendChild(product);
        });
    });
});
