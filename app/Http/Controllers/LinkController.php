<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLinkRequest;
use App\Models\Link;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LinkController extends Controller
{
    public function index(): View
    {
        $links = auth()->user()->links()
            ->withCount('clicks')
            ->latest()
            ->get();

        return view('links.index', compact('links'));
    }

    public function create(): View
    {
        return view('links.create');
    }

    public function store(StoreLinkRequest $request): RedirectResponse
    {
        auth()->user()->links()->create([
            'original_url' => $request->original_url,
            'short_code' => Link::generateUniqueShortCode(),
        ]);

        return redirect()->route('links.index')->with('status', 'Ссылка создана');
    }

    public function show(Link $link): View
    {
        $this->authorize('view', $link);

        $clicks = $link->clicks()->latest('clicked_at')->paginate(20);

        return view('links.show', compact('link', 'clicks'));
    }

    public function destroy(Link $link): RedirectResponse
    {
        $this->authorize('delete', $link);

        $link->delete();

        return redirect()->route('links.index')->with('status', 'Ссылка удалена');
    }
}