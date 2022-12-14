<ul class="list-inline browse-categories">
    @foreach ($categories as $category)
        <li :class="{ active: queryParams.category === '{{ $category->slug }}' }">
            <a
                href="{{ route('categories.products.index', ['category' => $category->slug]) }}"
                @click.prevent="changeCategory({{ $category }})"
            >
                {{ $category->name }}
            </a>

            @if ($category->items->isNotEmpty())
                @include('public.products.index.browse_sub_categories', ['subCategories' => $category->items])
            @endif
        </li>
    @endforeach
</ul>
