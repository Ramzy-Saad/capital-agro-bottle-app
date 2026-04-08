@extends('layouts.app')

@section('content')
<h2>Add Ingredient</h2>

<form method="POST" action="{{ route('ingredients.store') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" class="form-control" name="name" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="number" class="form-control" name="price" step="0.01" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Unit</label>
        <select name="unit" class="form-select" required>
            <option value="g">Gram</option>
            <option value="ml">ML</option>
            <option value="piece">Piece</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection