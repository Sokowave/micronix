<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;

class ProductSearchController extends Controller
{
    public function suggestions(Request $request)
    {
        $query = $request->input('q');

        if (!$query || strlen($query) < 2) {
            return response()->json([]);
        }

        $query = trim($query);

        $tagMatches = Tag::whereHas('products', function($q) {
                $q->whereNotNull('id');
            })
            ->where('name', 'like', $query . '%')
            ->limit(10)
            ->pluck('name');

        $products = Product::where('title', 'like', '%' . $query . '%')
            ->limit(20)
            ->pluck('title');

        $phraseSuggestions = collect();

        foreach ($products as $name) {
            $normalized = trim(preg_replace('/\s+/', ' ', $name));
            $spaceWords = preg_split('/\s+/', $normalized);

            for ($i = 0; $i < count($spaceWords); $i++) {
                $phrase = '';
                for ($j = 0; $j < 4 && ($i + $j) < count($spaceWords); $j++) {
                    $phrase .= ' ' . $spaceWords[$i + $j];
                    $cleanPhrase = trim($phrase);

                    if (preg_match('/[^\p{L}\p{N}\s]/u', $cleanPhrase)) {
                        continue;
                    }

                    if (stripos($cleanPhrase, $query) === 0) {
                        $phraseSuggestions->push($cleanPhrase);
                    }
                }
            }
        }

        $results = $tagMatches
            ->merge($phraseSuggestions)
            ->map(fn($item) => ucwords(strtolower(trim($item))))
            ->unique()
            ->take(10)
            ->values();

        return response()->json($results);
    }

}
