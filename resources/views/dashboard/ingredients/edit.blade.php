@extends('layouts.app')

@section('content')
<h2>Edit Ingredient</h2>

<form method="POST" action="{{ route('ingredients.update', $ingredient->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" class="form-control" name="name" value="{{ $ingredient->name }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="number" class="form-control" min="0" name="price" step="0.01" value="{{ $ingredient->price }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Unit</label>
        <select name="unit" class="form-select" required>
            @foreach($units as $key => $label)
                <option value="{{ $key }}" {{ $ingredient->unit == $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection