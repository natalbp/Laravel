<h1>Aquí van todos los productos listados</h1>

@foreach($products as $product) 
    <ul>
        <li>{{ $product->name }}</li>
    </ul>
@endforeach 