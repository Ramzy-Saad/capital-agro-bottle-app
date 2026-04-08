@extends('layouts.app')

@section('content')
<h2>Add Attribute</h2>

<form method="POST" action="{{ route('attributes.store') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Attribute Name</label>
        <input type="text" class="form-control" name="name" required>
    </div>

    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection