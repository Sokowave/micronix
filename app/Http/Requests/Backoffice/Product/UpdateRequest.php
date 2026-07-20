<?php

namespace App\Http\Requests\Backoffice\Product;

use App\Models\Product;
use Illuminate\Validation\Rule;

class UpdateRequest extends ProductRequest
{
    protected function imagesRules(): array
    {
        return [
            'nullable',
            'array',
            'max:8',
        ];
    }

    protected function slugRules(): array
    {
        return [
            'nullable',
            'string',
            'max:255',
            Rule::unique('products', 'slug')
                ->ignore($this->product()),
        ];
    }

    protected function skuRules(): array
    {
        return [
            'nullable',
            'string',
            'max:255',
            Rule::unique('products', 'sku')
                ->ignore($this->product()),
        ];
    }

    protected function product(): Product
    {
        return $this->route('product');
    }
}