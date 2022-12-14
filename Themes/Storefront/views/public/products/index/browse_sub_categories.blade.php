<ul>
    @foreach ($subCategories as $subCategory)
        <li :class="{ active: queryParams.category === '{{ $subCategory->slug }}' }">
            <a
                href="{{ route('categories.products.index', ['category' => $subCategory->slug]) }}"
                @click.prevent="changeCategory({{ $subCategory }})"
            >
                {{ $subCategory->name }}
            </a>

            @if ($subCategory->items->isNotEmpty())
                @include('public.products.index.browse_sub_categories', ['subCategories' => $subCategory->items])
            @endif
        </li>
    @endforeach
</ul>
