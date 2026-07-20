<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\Media\MediaUploaderService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SiteSettingsController extends Controller
{
    public function __construct(
        protected MediaUploaderService $mediaUploader
    ) {
        
    }

    /**
     * Display the requested settings page.
     */
    public function edit(string $section): View
    {
        return view(
            "backend.web-settings.{$section}",
            [
                'settings' => SiteSetting::all(),
            ]
        );
    }

    /**
     * Update website settings.
     */
    public function update(Request $request): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Determine submitted setting keys.
        |--------------------------------------------------------------------------
        |
        | Supports:
        | - Legacy forms using keys[]
        | - New forms without keys[]
        | - Mixed forms
        |
        */

        $manualKeys = $request->input('keys', []);

        $autoKeys = collect(
            $request->except([
                '_token',
                '_method',
                'keys',
            ])
        )
            ->keys()
            ->reject(fn (string $key) => str_ends_with($key, '_remove'))
            ->values()
            ->all();

        $keys = collect($manualKeys)
            ->merge($autoKeys)
            ->unique()
            ->values()
            ->all();

        foreach ($keys as $key) {

            try {

                /*
                |--------------------------------------------------------------------------
                | Media Upload
                |--------------------------------------------------------------------------
                */

                if ($request->hasFile($key)) {

                    $media = $this->mediaUploader->upload(
                        $request->file($key),
                        'site-assets'
                    );

                    SiteSetting::set(
                        $key,
                        $media->id,
                        'media'
                    );

                    Cache::forget("settings.{$key}");

                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Get submitted value.
                |--------------------------------------------------------------------------
                */

                $value = $request->input($key);

                /*
                |--------------------------------------------------------------------------
                | Save setting.
                |--------------------------------------------------------------------------
                */

                SiteSetting::set(
                    $key,
                    $value
                );

                Cache::forget("settings.{$key}");

            } catch (Exception $e) {

                Log::error(
                    "Failed updating site setting.",
                    [
                        'key' => $key,
                        'message' => $e->getMessage(),
                        'trace' => $e->getTraceAsString(),
                    ]
                );
            }
        }

        return back()->with(
            'success',
            'Settings updated successfully.'
        );
    }
}