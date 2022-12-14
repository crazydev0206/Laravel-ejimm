<div class="form-group variant-check">
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
                <div class="form-check">
                    <input
                        type="checkbox"
                        name="options[{{ $option->id }}][]"
                        id="option-{{ $option->id }}-value-{{ $value->id }}"
                        value="{{ $value->id }}"
                        @change="updateCheckboxTypeOptionValue({{ $option->id }}, $event)"
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
