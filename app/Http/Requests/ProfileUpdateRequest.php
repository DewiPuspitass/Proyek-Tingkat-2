<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/', 'max:255'],
            'no_telp' => ['required', 'string', 'regex:/^[0-9]+$/', 'min:10', 'max:12', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }

    public function messages(): array
{
    return [
        'name.required' => 'Nama wajib diisi.',
        'name.regex' => 'Nama harus berupa teks.',
        'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
        
        'no_telp.required' => 'Nomor telepon wajib diisi.',
        'no_telp.min' => 'Nomor telepon tidak boleh kurang dari 10 karakter.',
        'no_telp.max' => 'Nomor telepon tidak boleh lebih dari 12 karakter.',
        'no_telp.unique' => 'No. telepon sudah digunakan.',
        'no_telp.regex' => 'Nomor telepon hanya boleh berisi angka.',
    ];
}

}
