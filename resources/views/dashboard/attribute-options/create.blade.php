@extends('layouts.app')

@section('content')
<h2>Add Option</h2>

<form method="POST" action="{{ route('attribute-options.store') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Attribute</label>
        <select name="attribute_id" class="form-control" required>
            @foreach($attributes as $attribute)
                <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Option Name</label>
        <input type="text" class="form-control" name="name" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="number" step="0.01" class="form-control" name="price" required>
    </div>

    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection