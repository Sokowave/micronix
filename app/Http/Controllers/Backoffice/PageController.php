<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display a listing of the pages.
     */
    public function index(): View
    {
        $pages = Page::query()
            ->latest('updated_at')
            ->get();

        return view('backend.pages.index', compact('pages'));
    }

    /**
     * Show the form for editing the specified page.
     */
    public function edit(Page $page): View
    {
        return view('backend.pages.edit', compact('page'));
    }

    /**
     * Update the specified page.
     */
    public function update(Request $request, Page $page): RedirectResponse
    {
        $validated = $request->validate([
            'content' => ['nullable', 'string'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        $page->update($validated);

        return redirect()
            ->route('backoffice.pages.index')
            ->with('success', 'Page updated successfully.');
    }
}