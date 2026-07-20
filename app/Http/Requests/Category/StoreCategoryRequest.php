<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Category::class);
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->input('name')),
        ]);
    }

    /**
     * Get the validation rules.
     */
    public function rules(): array
    {
        return [
            'parent_id' => [
                'nullable',
                'integer',
                'exists:categories,id',
            ],

            'media_id' => [
                'nullable',
                'integer',
                'exists:media,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->where(
                    fn ($query) => $query->where('parent_id', $this->input('parent_id'))
                ),
            ],

            'meta_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'meta_description' => [
                'nullable',
                'string',
            ],

            'is_featured' => [
                'sometimes',
                'boolean',
            ],

            'is_active' => [
                'sometimes',
                'boolean',
            ],
        ];
    }

    /**
     * Custom attribute names.
     */
    public function attributes(): array
    {
        return [
            'parent_id' => 'parent category',
            'media_id' => 'image',
            'meta_title' => 'SEO title',
            'meta_description' => 'SEO description',
            'slug' => 'category slug',
        ];
    }
}