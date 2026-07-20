<?php

namespace App\Http\Requests\Backoffice\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

abstract class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return array_merge(
            $this->relationshipRules(),
            $this->productRules(),
            $this->specificationRules(),
            $this->inventoryRules(),
            $this->pricingRules(),
            $this->detailRules(),
            $this->publishingRules(),
            $this->seoRules(),
            $this->mediaRules(),
            $this->tagRules(),
        );
    }

    protected function relationshipRules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'brand_id' => ['nullable', 'exists:brands,id'],
        ];
    }

    protected function productRules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => $this->slugRules(),
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }

    protected function specificationRules(): array
    {
        return [
            'specifications' => ['nullable', 'array'],
            'specifications.*.name' => ['required_with:specifications', 'string', 'max:255'],
            'specifications.*.value' => ['required_with:specifications', 'string', 'max:1000'],
        ];
    }

    protected function inventoryRules(): array
    {
        return [
            'sku' => $this->skuRules(),
            'stock' => ['required', 'integer', 'min:0'],
        ];
    }

    protected function pricingRules(): array
    {
        return [
            'price' => ['required', 'numeric', 'gt:0'],
            'sale_price' => ['nullable', 'numeric', 'gt:0', 'lte:price'],
            'sale_starts_at' => ['nullable', 'date'],
            'sale_ends_at' => ['nullable', 'date', 'after_or_equal:sale_starts_at'],
        ];
    }

    protected function detailRules(): array
    {
        return [
            'featured' => ['sometimes', 'boolean'],
            'condition' => ['required', Rule::in(['new', 'refurbished', 'used'])],
            'color' => ['nullable', 'string', 'max:100'],
            'model' => ['nullable', 'string', 'max:255'],
            'warranty' => ['nullable', 'integer', 'min:0'],
        ];
    }

    protected function publishingRules(): array
    {
        return [
            'status' => ['required', Rule::in(['draft', 'published'])],
            'published_at' => ['nullable', 'date'],
        ];
    }

    protected function seoRules(): array
    {
        return [
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    protected function mediaRules(): array
    {
        return [
            'images' => $this->imagesRules(),

            'images.*' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,avif',
                'max:5120',
                Rule::dimensions()
                    ->minWidth(500)
                    ->minHeight(500)
                    ->maxWidth(2000)
                    ->maxHeight(2000),
            ],

            'existing_media' => ['nullable', 'array'],

            'existing_media.*' => [
                'integer',
                'distinct',
                'exists:media,id',
            ],

            'remove_media_ids' => ['nullable', 'array'],

            'remove_media_ids.*' => [
                'integer',
                'distinct',
                'exists:media,id',
            ],
        ];
    }

    protected function tagRules(): array
    {
        return [
            'tags' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'images.min' => 'Upload at least one image.',
            'images.max' => 'You may upload a maximum of 8 images.',
            'images.*.image' => 'Each image must be a valid image.',
            'images.*.mimes' => 'Images must be JPG, JPEG, PNG, WEBP or AVIF.',
            'images.*.max' => 'Each image must not be larger than 5 MB.',
            'images.*.dimensions' => 'Each image must be between 500 × 500 and 2000 × 2000 pixels.',
        ];
    }

    protected function imagesRules(): array
    {
        return [
            'required',
            'array',
            'min:1',
            'max:8',
        ];
    }

    protected function slugRules(): array
    {
        return [
            'nullable',
            'string',
            'max:255',
            'unique:products,slug',
        ];
    }

    protected function skuRules(): array
    {
        return [
            'nullable',
            'string',
            'max:255',
            'unique:products,sku',
        ];
    }
}