<?php

namespace Themes\Storefront\Http\Controllers;

class NewsletterPopup
{
    public function store()
    {
        $cookie = cookie()->forever('show_newsletter_popup', true);

        return response('')->withCookie($cookie);
    }

    public function destroy()
    {
        $cookie = cookie()->forever('show_newsletter_popup', false);

        return response('')->withCookie($cookie);
    }
}
