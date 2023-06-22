<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//use PhpParser\Node\NullableType;
use Illuminate\Validation\Validator;

// namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
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
            "image" => "nullable|mimes:Jpg,JPEG,png,bmp,jfif,webp|max:5112",
           // "image" => "nullable",


            //
        ];
    }
}
