<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|max:255",
            "image" => "required|mimes:Jpg,JPEG,png,bmp,jfif,webp|max:5112",
        ];
    }

//    public function messages(): array
//    {
//        return [
//          "name.required"=>"الاسم مطلوب",
//          "name.numeric"=>"يجب ان يكون قيمة رقمية",
//          "name.unique"=>" هذا الاسم موجود من قبل"
//        ];
//    }
}
