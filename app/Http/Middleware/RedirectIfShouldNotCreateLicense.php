<?php

namespace FleetCart\Http\Middleware;

use Closure;
use FleetCart\License;

class RedirectIfShouldNotCreateLicense
{
    private $license;

    public function __construct(License $license)
    {
        $this->license = $license;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      return redirect()->intended('/admin');
        // if ($this->license->valid() || ! $this->license->shouldCreateLicense()) {
        // }

        return $next($request);
    }
}
