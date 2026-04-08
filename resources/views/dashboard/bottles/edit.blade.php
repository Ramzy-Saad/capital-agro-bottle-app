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

    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection