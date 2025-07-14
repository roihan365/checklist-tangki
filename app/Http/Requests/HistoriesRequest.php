<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistoriesRequest extends FormRequest
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
        return [
            'name' => 'required|max:255|unique:histories,name,' . $this->route('histories'),
            'uploadfile'  => 'required|pdf|max:2048',
            'keterangan'
        ];
    }
}
