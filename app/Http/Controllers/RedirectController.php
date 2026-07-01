<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\RedirectResponse;

class RedirectController extends Controller
{
    public function __invoke(string $code): RedirectResponse
    {
        $link = Link::where('short_code', $code)->firstOrFail();

        $link->clicks()->create([
            'ip_address' => request()->ip(),
            'clicked_at' => now(),
        ]);

        return redirect()->away($link->original_url);
    }
}