@if ($product->hasAnyAttribute())
    <div id="specification" class="tab-pane specification" :class="{ active: activeTab === 'specification' }">
        <div class="specification-inner">
            @foreach ($product->attributeSets as $attributeSet => $attributes)
                <div class="specification-row">
                    <div class="title">
                        <h5>{{ $attributeSet }}</h5>
                    </div>

                    <ul class="list-inline specification-list">
                        @foreach ($attributes as $attribute)
                            <li>
                                <label>{{ $attribute->name }}</label>
                                <span>{{ $attribute->values->implode('value', ', ') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
@endif
