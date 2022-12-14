<div class="form-group variant-input">
    <div class="row">
        <div class="col-xl-4 col-lg-6">
            <label for="option-{{ $option->id }}">
                {!!
                    $option->name .
                    $option->values->first()->formattedPriceForProduct($product) .
                    ($option->is_required ? '<span>*</span>' : '')
                !!}
            </label>
        </div>

        <div class="col-xl-10 col-lg-12">
            <div class="form-input">
                <input
                    name="options[{{ $option->id }}]"
                    class="form-control {{ array_pull($attributes, 'class') }}"
                    id="option-{{ $option->id }}"
                    v-model="cartItemForm.options[{{ $option->id }}]"
                    {{ html_attrs($attributes) }}
                >
            </div>

            <span
                class="error-message"
                v-if="errors.has('{{ "options.{$option->id}" }}')"
                v-text="errors.get('{{ "options.{$option->id}" }}')"
            >
            </span>
        </div>
    </div>
</div>
