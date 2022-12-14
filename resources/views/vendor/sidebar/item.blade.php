<li class="{{ $item->getItemClass() ? $item->getItemClass() : null }}
    {{ $active ? 'active' : null }}
    {{ $item->hasItems() ? 'treeview' : null }}
">
    <a href="{{ $item->getUrl() }}" class="{{ count($appends) > 0 ? 'hasAppend' : null }}"
        @if ($item->getNewTab())
            target="_blank"
        @endif
    >
        <i class="{{ $item->getIcon() }}"></i>
        <span>{{ $item->getName() }}</span>

        @foreach ($badges as $badge)
            {!! $badge !!}
        @endforeach

        @if ($item->hasItems())
            <span class="pull-right-container">
                <i class="{{ $item->getToggleIcon() }} pull-right"></i>
            </span>
        @endif
    </a>

    @foreach ($appends as $append)
        {!! $append !!}
    @endforeach

    @if (count($items) > 0)
        <ul class="treeview-menu">
            @foreach ($items as $item)
                {!! $item !!}
            @endforeach
        </ul>
    @endif
</li>
