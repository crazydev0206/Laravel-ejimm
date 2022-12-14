<div class="form-group variant-radio">
    <div class="row">
        <div class="col-xl-4 col-lg-6">
            <label>
                {!!
                    $option->name .
                    ($option->is_required ? '<span>*</span>' : '')
                !!}
            </label>
        </div>

        <div class="col-xl-10 col-lg-12">
            @foreach ($option->values as $value)
                <div class="form-radio">
                    <input
                        type="radio"
                        name="options[{{ $option->id }}]"
                        value="{{ $value->id }}"
                        id="option-{{ $option->id }}-value-{{ $value->id }}"
                        v-model="cartItemForm.options[{{ $option->id }}]"
                    >

                    <label for="option-{{ $option->id }}-value-{{ $value->id }}">
                        {!!
                            $value->label .
                            $value->formattedPriceForProduct($product)
                        !!}
                    </label>
                </div>
            @endforeach

            <span
                class="error-message"
                v-if="errors.has('{{ "options.{$option->id}" }}')"
                v-text="errors.get('{{ "options.{$option->id}" }}')"
            >
        </div>
    </div>
</div>
