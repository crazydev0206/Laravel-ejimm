<div class="form-group variant-custom-selection">
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
            <ul class="list-inline form-custom-radio custom-selection">
                @foreach ($option->values as $value)
                    <li
                        :class="{ active: customCheckboxTypeOptionValueIsActive({{ $option->id }}, {{ $value->id }}) }"
                        @click="syncCustomCheckboxTypeOptionValue({{ $option->id }}, {{ $value->id }})"
                    >
                        {!!
                            $value->label .
                            $value->formattedPriceForProduct($product)
                        !!}
                    </li>
                @endforeach
            </ul>

            <span
                class="error-message"
                v-if="errors.has('{{ "options.{$option->id}" }}')"
                v-text="errors.get('{{ "options.{$option->id}" }}')"
            >
        </div>
    </div>
</div>
