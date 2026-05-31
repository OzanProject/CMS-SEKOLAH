<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get preferred language from browser (id or en)
        // If 'id' is present in Accept-Language, prioritize it.
        // Otherwise default to 'en' (or whatever logic user wants for "luar indonesia")

        $preferred = $request->getPreferredLanguage(['id', 'en']);

        // If detection fails or returns something we support, set it.
        if ($preferred) {
            App::setLocale($preferred);
        } else {
            // Default fallback if header is missing
            App::setLocale('en');
        }

        return $next($request);
    }
}
