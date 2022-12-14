<div class="social-share">
    <label>{{ trans('storefront::product.share') }}</label>

    <ul class="list-inline social-links">
        <li>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" title="{{ trans('storefront::product.facebook') }}" target="_blank">
                <i class="lab la-facebook"></i>
            </a>
        </li>

        <li>
            <a href="https://twitter.com/share?url={{ url()->current() }}&text={{ $product->name }}" title="{{ trans('storefront::product.twitter') }}" target="_blank">
                <i class="lab la-twitter"></i>
            </a>
        </li>

        <li>
            <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}" title="{{ trans('storefront::product.linkedin') }}" target="_blank">
                <i class="lab la-linkedin"></i>
            </a>
        </li>

        <li>
            <a href="http://www.tumblr.com/share?v=3&u={{ url()->current() }}" title="{{ trans('storefront::product.tumblr') }}" target="_blank">
                <i class="lab la-tumblr"></i>
            </a>
        </li>
    </ul>
</div>
