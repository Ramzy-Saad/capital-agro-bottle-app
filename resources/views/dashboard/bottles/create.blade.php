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
        <input type="number" class="form-control" min="0" name="base_price" step="0.01" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Attributes</label>

        @foreach($attributes as $attribute)
            <div class="form-check">
                <input class="form-check-input"
                    type="checkbox"
                    name="attributes[]"
                    value="{{ $attribute->id }}"
                    id="attr_{{ $attribute->id }}">

                <label class="form-check-label" for="attr_{{ $attribute->id }}">
                    {{ $attribute->name }}
                </label>
            </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection