document.addEventListener('DOMContentLoaded', function() {
    const minPriceInput = document.getElementById('min-price');
    const maxPriceInput = document.getElementById('max-price');
    const products = document.querySelectorAll('.item');

    function filterProductsByPrice() {
        const minPrice = parseFloat(minPriceInput.value);
        const maxPrice = parseFloat(maxPriceInput.value);

        products.forEach(function(product) {
            const priceString = product.querySelector('.item-desc-price').textContent;
            const price = parseFloat(priceString.replace(/[^\d.-]/g, ''));

            if ((isNaN(minPrice) || price >= minPrice) && (isNaN(maxPrice) || price <= maxPrice)) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    }

    minPriceInput.addEventListener('input', filterProductsByPrice);
    maxPriceInput.addEventListener('input', filterProductsByPrice);
});
