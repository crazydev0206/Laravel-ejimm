@if ($subCategory->items->isNotEmpty())
    <ul class="list-inline sub-category-list">
        @foreach ($subCategory->items as $subCategoryItem)
            <li>
                <a href="{{ $subCategoryItem->url() }}" title="{{ $subCategoryItem->name }}">
                    {{ $subCategoryItem->name }}
                </a>
            </li>
        @endforeach
    </ul>
@endif
