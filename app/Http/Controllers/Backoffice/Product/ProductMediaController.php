<?php

namespace App\Http\Controllers\Backoffice\Product;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\JsonResponse;

class ProductMediaController extends Controller
{
    public function destroy(int $id): JsonResponse
    {
        $productImage = ProductImage::find($id);

        if (! $productImage) {
            return response()->json([
                'status' => 'error',
                'message' => 'Image not found.',
            ], 404);
        }

        $productImage->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Image deleted successfully.',
        ]);
    }
}