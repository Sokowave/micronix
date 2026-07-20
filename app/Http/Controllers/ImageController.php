<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ImageController extends Controller
{
    /**
     * Serve an optimized image stored on the public disk.
     *
     * Example:
     * /image/uploads/products/example.webp
     * /image/uploads/products/example.webp?w=300
     *
     * Note:
     * Width (w) and quality (q) parameters are reserved for future use.
     * Images are already optimized during upload.
     */
    public function __invoke(
        Request $request,
        string $path
    ): BinaryFileResponse {

        // Prevent directory traversal.
        abort_if(
            str_contains($path, '..'),
            404
        );

        $file = public_path(ltrim($path, '/'));

        abort_unless(
            is_file($file),
            404,
            'Image not found.'
        );

        $response = response()->file($file, [
            'Cache-Control' => 'public, max-age=31536000, immutable',
            'Expires'       => gmdate('D, d M Y H:i:s', strtotime('+1 year')) . ' GMT',
            'Last-Modified' => gmdate('D, d M Y H:i:s', filemtime($file)) . ' GMT',
        ]);

        $response->setEtag(md5_file($file));

        if ($response->isNotModified($request)) {
            return $response;
        }

        return $response;
    }
}