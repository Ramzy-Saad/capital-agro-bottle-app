@extends('layouts.app')

@section('content')
<h2>Create Order</h2>

<form method="POST" action="{{ route('order.store') }}">
    @csrf

    @dd($bottles)
    <div id="items-wrapper">

        <div class="item mb-4 p-3 border">
            <label>Bottle</label>
            <select name="items[0][bottle_id]" class="form-control bottle-select">
                <option value="">Select Bottle</option>

                @foreach($bottles??[] as $bottle)
                    <option value="{{ $bottle?->id }}">
                        {{ $bottle->name }} ({{ $bottle->base_price }})
                    </option>
                @endforeach
            </select>

            <div class="attributes mt-3"></div>
        </div>

    </div>

    <button type="button" id="add-item" class="btn btn-secondary mb-3">
        Add Another Bottle
    </button>

    <button type="submit" class="btn btn-success">Submit Order</button>
</form>
<script>
    let bottles = @json($bottles);
    let index = 0;

    document.getElementById('add-item').addEventListener('click', function () {
        index++;

        let html = `
        <div class="item mb-4 p-3 border">
            <label>Bottle</label>
            <select name="items[${index}][bottle_id]" class="form-control bottle-select">
                <option value="">Select Bottle</option>
                ${bottles.map(b => `<option value="${b.id}">${b.name} (${b.base_price})</option>`).join('')}
            </select>

            <div class="attributes mt-3"></div>
        </div>`;

        document.getElementById('items-wrapper').insertAdjacentHTML('beforeend', html);
    });

    document.addEventListener('change', function (e) {
        if (e.target.classList.contains('bottle-select')) {

            let bottleId = e.target.value;
            let itemDiv = e.target.closest('.item');
            let attrDiv = itemDiv.querySelector('.attributes');

            let bottle = bottles.find(b => b.id == bottleId);

            if (!bottle) {
                attrDiv.innerHTML = '';
                return;
            }

            let itemIndex = e.target.name.match(/\d+/)[0];

            let html = '';

            bottle.attributes.forEach(attr => {
                html += `<div class="mb-2">
                    <strong>${attr.name}</strong><br>`;

                attr.options.forEach(option => {
                    html += `
                        <label>
                            <input type="checkbox"
                                   name="items[${itemIndex}][options][]"
                                   value="${option.id}">
                            ${option.name} (+${option.price})
                        </label><br>
                    `;
                });

                html += `</div>`;
            });

            attrDiv.innerHTML = html;
        }
    });
</script>
@endsection