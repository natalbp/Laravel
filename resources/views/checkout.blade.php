<h1>Checkout</h1>

<div class="resumen">
    <form action="/orders" method= "post">
        <div id="products">
        </div>
        <button type="submit">Enviar</button>
        @csrf
    </form>
</div>


<script>

let carrito = JSON.parse(localStorage.getItem('carrito'));
let divProducts = document.getElementById('products');
carrito.map(product => {
    divProducts.innerHTML +=`<p>${product.cantidad} - ${product.name} - ${product.cantidad * product.price}</p>`;
    divProducts.innerHTML += `<input name='product_id[]' value='${product.id}' hidden>`;
    divProducts.innerHTML += `<input name='price[]' value='${product.price}' hidden>`;
    divProducts.innerHTML += `<input name='cantidad[]' value='${product.cantidad}' hidden>`;
})

</script>