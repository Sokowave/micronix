<?php

namespace App\Http\Requests\Backoffice\Staff;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreStaffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', User::class);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'user_type' => [
                'required',
                Rule::in([
                    'superadmin',
                    'staff',
                ]),
            ],

            'f_name' => [
                'required',
                'string',
                'max:100',
            ],

            'l_name' => [
                'nullable',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
                'unique:users,email',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
                'unique:users,phone',
            ],

            'status' => [
                'required',
                Rule::in([
                    'active',
                    'inactive',
                ]),
            ],

            'password' => [
                'required',
                'confirmed',
                Password::defaults(),
            ],
        ];
    }
}