<div class="home-banner-wrap">
    <a href="{{ $sliderBanners['banner_1']->call_to_action_url }}"
        class="banner"
        target="{{ $sliderBanners['banner_1']->open_in_new_window ? '_blank' : '_self' }}"
    >
        <img src="{{ $sliderBanners['banner_1']->image->path }}" alt="banner">
    </a>

    <a href="{{ $sliderBanners['banner_2']->call_to_action_url }}"
        class="banner m-t-30"
        target="{{ $sliderBanners['banner_2']->open_in_new_window ? '_blank' : '_self' }}"
    >
        <img src="{{ $sliderBanners['banner_2']->image->path }}" alt="banner">
    </a>
</div>
