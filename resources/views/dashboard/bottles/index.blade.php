@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Bottles</h2>
    <a href="{{ route('bottles.create') }}" class="btn btn-primary">Add Bottle</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bottles as $bottle)
        <tr>
            <td>{{ $bottle->name }}</td>
            <td>${{ $bottle->base_price }}</td>
            <td class="table-actions">
                <a href="{{ route('bottles.edit', $bottle->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('bottles.destroy', $bottle->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection