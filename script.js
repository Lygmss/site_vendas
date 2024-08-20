document.querySelectorAll('button').forEach(button => {
    button.addEventListener('click', () => {
        alert('Produto adicionado ao carrinho!');
    });
});

const categoryFilter = document.getElementById('category');
const priceFilter = document.getElementById('price');
const products = document.querySelectorAll('.product');

function filterProducts() {
    const selectedCategory = categoryFilter.value;
    const selectedPrice = priceFilter.value;

    products.forEach(product => {
        const productCategory = product.getAttribute('data-category');
        const productPrice = product.getAttribute('data-price');

        const categoryMatch = selectedCategory === 'all' || productCategory === selectedCategory;
        const priceMatch = selectedPrice === 'all' || productPrice === selectedPrice;

        if (categoryMatch && priceMatch) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });
}

categoryFilter.addEventListener('change', filterProducts);
priceFilter.addEventListener('change', filterProducts);
