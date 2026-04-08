@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h2>Attributes</h2>
        <a href="{{ route('attributes.create') }}" class="btn btn-primary">Add Attribute</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attributes as $attribute)
                <tr>
                    <td>{{ $attribute->name }}</td>
                    <td>
                        <a href="{{ route('attribute-options.create') }}" class="btn btn-sm btn-success">
                            Add Option
                        </a>
                        @foreach ($attribute->options as $option)
                            <span class="badge bg-info">
                                {{ $option->name }} (+{{ $option->price }})
                            </span>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
