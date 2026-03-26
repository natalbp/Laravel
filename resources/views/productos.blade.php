<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f8;
            color: #333;
            padding: 2rem;
        }

        h1 {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: #2c3e50;
        }

        .productos-lista {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
            list-style: none;
            margin-bottom: 2rem;
        }

        .producto-item {
            background: #fff;
            border-radius: 8px;
            padding: 1rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .producto-item span {
            font-weight: 600;
            font-size: 1rem;
        }

        .btn-agregar {
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 0.5rem 0.75rem;
            cursor: pointer;
            font-size: 0.875rem;
            transition: background-color 0.2s;
        }

        .btn-agregar:hover {
            background-color: #2980b9;
        }

        .btn-eliminar {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 0.25rem 0.5rem;
            cursor: pointer;
            font-size: 0.8rem;
            margin-left: 0.5rem;
            transition: background-color 0.2s;
        }

        .btn-eliminar:hover {
            background-color: #c0392b;
        }

        #carrito {
            background: #fff;
            border-radius: 8px;
            padding: 1.25rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            min-height: 60px;
        }

        #carrito h2 {
            font-size: 1.2rem;
            margin-bottom: 0.75rem;
            color: #2c3e50;
        }

        #carrito p {
            padding: 0.4rem 0;
            border-bottom: 1px solid #eee;
            font-size: 0.95rem;
        }

        #carrito p:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>

    <h1>Productos</h1>

    <ul class="productos-lista">
        @foreach($products as $product)
            <li class="producto-item">
                <div class="imagen">
                <img src="https://static.wikia.nocookie.net/despicableme/images/9/93/Otto_standing.png/revision/latest/scale-to-width-down/1200?cb=20241103152642" alt="{{ $product->name }}" width="100%">
                </div>
                <span>{{ $product->name }}</span>
                <span>{{ $product->description }}</span>
                <span>{{ $product->price }}</span>

                <button class="btn-agregar" onclick='agregarAlCarrito(@json($product))'>Añadir al carrito</button>
            </li>
        @endforeach
    </ul>

    <div id="carrito">
        <h2>Carrito</h2>
    </div>

    <script>
        let carrito = JSON.parse(localStorage.getItem("carrito"));
        carrito = carrito ? carrito : []
        console.log("carrito", carrito)
        mostrarCarrito();

        function agregarAlCarrito(product) {
            let posicion = carrito.findIndex(item => item.id === product.id);
            if (posicion !== -1) {
                carrito[posicion].cantidad++;
            } else {
                product.cantidad = 1;
                carrito.push(product);
            }

        localStorage.setItem("carrito", JSON.stringify(carrito));
        console.log(carrito)
        mostrarCarrito();
        }


        function mostrarCarrito() {
            let divCarrito = document.getElementById('carrito');
            divCarrito.innerHTML = '<h2>Carrito de Compras</h2>';
            let suma = 0;
            carrito.forEach((item, index) => {
                suma += item.cantidad * item.price;

                divCarrito.innerHTML += `
                    <p>
                        ${item.name} - Cantidad: ${item.cantidad} : ${item.price * item.cantidad}
                        <button class="btn-eliminar" onclick="eliminarDelCarrito(${index})">Eliminar</button>
                    </p>
                `;
            });
            divCarrito.innerHTML += `<p>Total: ${suma}</p>`;
            divCarrito.innerHTML += `<a href="/checkout">Continuar al Pago</a>`;
        }


        function eliminarDelCarrito(posicion) {
            if (carrito[posicion].cantidad > 1) {
                carrito[posicion].cantidad--;
            } else {
                carrito.splice(posicion, 1);
            }
            localStorage.setItem("carrito", JSON.stringify(carrito));
            mostrarCarrito();
        }
    </script>

</body>
</html>
