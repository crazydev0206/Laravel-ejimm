<section class="home-section-wrap">
    <div class="containe">
        <div class="row">
            <!--<div class="col-md-4">
                @if ($categoryMenu->menus()->isNotEmpty())
                    <div class="category-dropdown-wrap custom-category-bar">
                        <div class="category-dropdown">
                            <ul class="list-inline mega-menu vertical-megamenu">
                                @foreach ($categoryMenu->menus() as $menu)
                                    @include('public.layout.navigation.menu', ['type' => 'category_menu'])
                                @endforeach

                                <li class="more-categories">
                                    <a href="{{ route('categories.index') }}" class="menu-item">
                                        <span class="menu-item-icon">
                                            <i class="las la-plus-square"></i>
                                        </span>

                                        {{ trans('storefront::layout.all_categories') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif
            </div> -->
            <div class="home-section-inner col-md-18">
                
                <div class="home-slider-wrap">
                    <div
                        class="home-slider"
                        data-speed="{{ $slider->speed ?? '1000' }}"
                        data-autoplay="{{ $slider->autoplay ?? 'false' }}"
                        data-autoplay-speed="{{ $slider->autoplay_speed ?? '5000' }}"
                        data-fade="{{ $slider->fade ?? 'false' }}"
                        data-dots="{{ $slider->dots ?? 'true' }}"
                        data-arrows="{{ $slider->arrows ?? 'true' }}"
                    >
                        @foreach ($slider->slides as $slide)
                            <div class="slide">
                                <img src="{{ $slide->file->path }}" data-animation-in="zoomInImage" class="slider-image animated">

                                <div class="slide-content {{ $slide->isAlignedLeft() ? 'align-left' : 'align-right' }}">
                                    <div class="captions">
                                        <span
                                            class="caption caption-1"
                                            data-animation-in="{{ data_get($slide->options, 'caption_1.effect', 'fadeInRight') }}"
                                            data-delay-in="{{ data_get($slide->options, 'caption_1.delay', '0') }}"
                                        >
                                            {!! $slide->caption_1 !!}
                                        </span>

                                        <span
                                            class="caption caption-2"
                                            data-animation-in="{{ data_get($slide->options, 'caption_2.effect', 'fadeInRight') }}"
                                            data-delay-in="{{ data_get($slide->options, 'caption_2.delay', '0.3') }}"
                                        >
                                            {!! $slide->caption_2 !!}
                                        </span>

                                        @if ($slide->call_to_action_text)
                                            <a
                                                href="{{ $slide->call_to_action_url }}"
                                                class="btn btn-primary btn-slider"
                                                data-animation-in="{{ data_get($slide->options, 'call_to_action.effect', 'fadeInRight') }}"
                                                data-delay-in="{{ data_get($slide->options, 'call_to_action.delay', '0.7') }}"
                                                target="{{ $slide->open_in_new_window ? '_blank' : '_self' }}"
                                            >
                                                {!! $slide->call_to_action_text !!}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                @include('public.home.sections.slider_banners')
            </div>
        </div>
    </div>
</section>
