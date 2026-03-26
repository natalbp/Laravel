<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function store()
    {
        $orden = new Order();
        $orden->user_id = 1;
        $orden->metodo_pago = "Tarjeta";
        $orden->save();


        $orden->products()->attach(1, [
            'price' => 100.00,
            'cantidad' => 2
        ]);


        return Order::with('products')->find($orden->id);
    }
}