<h1>Aquí van todos los productos listados</h1>

<div id="carrito">

</div>

@foreach($products as $product) 
    <ul>
        <li>
            {{ $product->name }}
            <button onclick="agregarAlCarrito({{ $product }})"> Añadir al carrito </button>
        </li>
    </ul>
@endforeach 

<script>
    let carrito = []
    function agregarAlCarrito(product) {
        let posicion = carrito.findIndex(item => item.id === product.id); 
        if (posicion !== -1) {
            //El producto ya existe en el carrito, incrementamos su cantidad
            carrito[posicion].cantidad++;
        } else {
            //No existe el producto en el carrito, lo agregamos con cantidad 1
            product.cantidad = 1;
            carrito.push(product);
        }
        console.log(carrito);
    }

    function mostrarCarrito(){
        let divCarrito = document.getElementById('carrito');
        carrito.map(item =>{
            divCarrito.innerHTML += `<p>${item.name} - Cantidad: ${item.cantidad}</p>`;
        })
    }
</script>