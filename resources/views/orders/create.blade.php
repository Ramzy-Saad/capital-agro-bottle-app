@extends('layouts.app')

@section('content')
    <h2>Create Order</h2>

    <form method="POST" action="{{ route('order.store') }}">
        @csrf

        <!-- Select Bottle -->
        <div class="mb-3">
            <label class="form-label">Select Bottle</label>
            <select name="bottle_id" class="form-select" required>
                <option value="">-- Choose Bottle --</option>
                @foreach($bottles as $bottle)
                    <option value="{{ $bottle->id }}" data-price="{{ $bottle->base_price }}">
                        {{ $bottle->name }} (${{ $bottle->base_price }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Ingredients -->
        <h4>Ingredients</h4>
        <div class="row" id="ingredients-container">
            @foreach($ingredients as $ingredient)
                <div class="col-md-4 mb-2 ingredient-card">
                    <div class="card p-2">
                        <div class="form-check">
                            <input class="form-check-input ingredient-checkbox" type="checkbox"
                                name="ingredients[{{ $ingredient->id }}][id]" value="{{ $ingredient->id }}"
                                data-price="{{ $ingredient->price }}">
                            <label class="form-check-label">
                                {{ $ingredient->name }} ({{ $ingredient->unit }}) - ${{ $ingredient->price }}
                            </label>
                        </div>

                        <input type="number" min="0" step="0.01" class="form-control mt-1 ingredient-qty"
                            name="ingredients[{{ $ingredient->id }}][quantity]" value="0" disabled>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Total Price -->
        <div class="mt-3">
            <h4>Total: $<span id="total-price">0.00</span></h4>
        </div>

        <button type="submit" class="btn btn-success mt-2">Create Order</button>
    </form>
@endsection

@section('scripts')
    <script>
        const bottleSelect = document.querySelector('select[name="bottle_id"]');
        const ingredientCheckboxes = document.querySelectorAll('.ingredient-checkbox');
        const ingredientQtys = document.querySelectorAll('.ingredient-qty');
        const totalPriceEl = document.getElementById('total-price');

        function calculateTotal() {
            let total = 0;

            // bottle price
            const selectedBottle = bottleSelect.selectedOptions[0];
            if (selectedBottle) total += parseFloat(selectedBottle.dataset.price);

            ingredientCheckboxes.forEach((checkbox, i) => {
                if (checkbox.checked) {
                    const qty = parseFloat(ingredientQtys[i].value) || 0;
                    total += parseFloat(checkbox.dataset.price) * qty;
                }
            });

            totalPriceEl.textContent = total.toFixed(2);
        }

        bottleSelect.addEventListener('change', calculateTotal);

        ingredientCheckboxes.forEach((checkbox, i) => {
            checkbox.addEventListener('change', () => {
                ingredientQtys[i].disabled = !checkbox.checked;
                if (!checkbox.checked) ingredientQtys[i].value = 0;
                calculateTotal();
            });

            ingredientQtys[i].addEventListener('input', calculateTotal);
        });
    </script>
@endsection