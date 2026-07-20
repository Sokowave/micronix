<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\BannerLocation;
use Illuminate\Http\Request;

class BannerLocationController extends Controller
{
    public function index()
    {
        $locations = BannerLocation::withCount('banners')->latest()->paginate(10);

        return view('backend.banner_locations.index', compact('locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => ['required', 'string', 'max:255', 'unique:banner_locations,key'],
            'name' => ['required', 'string', 'max:255'],
            'width' => ['nullable', 'integer', 'min:1'],
            'height' => ['nullable', 'integer', 'min:1'],

            'max_banners' => ['nullable', 'integer', 'min:1'],
        ]);

        BannerLocation::create([
            'key' => $validated['key'],
            'name' => $validated['name'],
            'width' => $validated['width'] ?? null,
            'height' => $validated['height'] ?? null,
            'max_banners' => $validated['max_banners'] ?? 1, // default = 1
        ]);

        return redirect()
            ->route('backoffice.banner-locations.index')
            ->with('success', 'Banner location created successfully.');
    }

    public function update(Request $request, BannerLocation $bannerLocation)
    {
        $validated = $request->validate([
            'key' => [
                'required',
                'string',
                'max:255',
                'unique:banner_locations,key,' . $bannerLocation->id
            ],
            'name' => ['required', 'string', 'max:255'],
            'width' => ['nullable', 'integer', 'min:1'],
            'height' => ['nullable', 'integer', 'min:1'],

            'max_banners' => ['nullable', 'integer', 'min:1'],
        ]);

        $bannerLocation->update([
            'key' => $validated['key'],
            'name' => $validated['name'],
            'width' => $validated['width'] ?? null,
            'height' => $validated['height'] ?? null,
            'max_banners' => $validated['max_banners'] ?? 1,
        ]);

        return redirect()
            ->route('backoffice.banner-locations.index')
            ->with('success', 'Banner location updated successfully.');
    }

    public function destroy(BannerLocation $bannerLocation)
    {
        if ($bannerLocation->banners()->exists()) {
            return back()->withErrors([
                'error' => 'Cannot delete banner location with existing banners.'
            ]);
        }

        $bannerLocation->delete();

        return redirect()
            ->route('backoffice.banner-locations.index')
            ->with('success', 'Banner location deleted successfully.');
    }
}
