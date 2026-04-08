@extends('layouts.app')

@section('content')
<h2>Add Bottle</h2>

<form method="POST" action="{{ route('bottles.store') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" class="form-control" name="name" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Base Price</label>
        <input type="number" class="form-control" name="base_price" step="0.01" required>
    </div>

    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection