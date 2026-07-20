<?php

namespace App\Http\Requests\Backoffice\Staff;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateStaffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /** @var User $staff */
        $staff = $this->route('staff');

        return $this->user()->can('update', $staff);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        /** @var User $staff */
        $staff = $this->route('staff');

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
                Rule::unique('users', 'email')->ignore($staff),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
                Rule::unique('users', 'phone')->ignore($staff),
            ],

            'status' => [
                'required',
                Rule::in([
                    'active',
                    'inactive',
                ]),
            ],

            'password' => [
                'nullable',
                'confirmed',
                Password::defaults(),
            ],
        ];
    }
}