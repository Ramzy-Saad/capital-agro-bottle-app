@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Ingredients</h2>
    <a href="{{ route('ingredients.create') }}" class="btn btn-primary">Add Ingredient</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Unit</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ingredients as $ingredient)
        <tr>
            <td>{{ $ingredient->name }}</td>
            <td>${{ $ingredient->price }}</td>
            <td>{{ $ingredient->unit }}</td>
            <td class="table-actions">
                <a href="{{ route('ingredients.edit', $ingredient->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('ingredients.destroy', $ingredient->id) }}" method="POST">
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