@extends('layouts.app')

@section('content')
<h2>Edit Bottle</h2>

<form method="POST" action="{{ route('bottles.update', $bottle->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" class="form-control" name="name" value="{{ $bottle->name }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Base Price</label>
        <input type="number" class="form-control" min="0" name="base_price" step="0.01" value="{{ $bottle->base_price }}" required>
    </div>
    @foreach($attributes as $attribute)
        <div class="form-check">
            <input class="form-check-input"
                type="checkbox"
                name="attributes[]"
                value="{{ $attribute->id }}"
                {{ $bottle->attributes->contains($attribute->id) ? 'checked' : '' }}>

            <label class="form-check-label">
                {{ $attribute->name }}
            </label>
        </div>
    @endforeach

    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection