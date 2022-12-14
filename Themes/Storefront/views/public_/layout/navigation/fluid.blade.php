<ul
    class="list-inline fluid-menu-wrap"

    @if ($menu->hasBackgroundImage())
        style="background-image: url({{ $menu->backgroundImage() }});"
    @endif
>
    <li>
        <div class="fluid-menu-content">
            @foreach ($subMenus as $subMenu)
                <div class="fluid-menu-list">
                    <h5 class="fluid-menu-title">
                        <a href="{{ $subMenu->url() }}" target="{{ $subMenu->target() }}">
                            {{ $subMenu->name() }}
                        </a>
                    </h5>

                    <ul class="list-inline fluid-sub-menu-list">
                        @foreach ($subMenu->items() as $item)
                            <li>
                                <a href="{{ $item->url() }}" target="{{ $subMenu->target() }}">
                                    {{ $item->name() }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </li>
</ul>
