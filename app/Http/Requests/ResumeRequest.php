<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResumeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required',
            'email' => 'required|email',
            'current_position' => 'required',
            'experience' => 'required',
            'technologies' => 'required',
            // 'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'companies' => 'required',
        ];
    }
}
