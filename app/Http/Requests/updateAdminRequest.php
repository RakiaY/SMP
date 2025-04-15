<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Gender;

class updateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $adminId = $this->route('id');
        return [
            'first_name' => 'sometimes|required|string|min:2|max:50',//sometimes|required:optionnels mais validés s’ils sont présents
            'last_name' => 'sometimes|required|string|min:2|max:50',
            'email' => ['sometimes','required','email','max:255',
                Rule::unique('users', 'email')->ignore($adminId),],
            'password' => ['sometimes','nullable','min:8','max:64','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/' ],
            'phone' => 'sometimes|string|min:8|max:20',
            'gender' => ['sometimes', 'required', Rule::enum(Gender::class)],
        ];
    }
}
