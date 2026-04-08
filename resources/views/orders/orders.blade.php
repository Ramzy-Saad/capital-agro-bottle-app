@extends('layouts.app')

@section('content')
<h2>Orders</h2>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Bottle</th>
            <th>Total Price</th>
            <th>Ingredients</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->bottle->name }}</td>
            <td>${{ $order->total_price }}</td>
            <td>
                @foreach($order->ingredients as $ingredient)
                    {{ $ingredient->name }}: {{ $ingredient->pivot->quantity }}{{ $ingredient->unit }} <br>
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection