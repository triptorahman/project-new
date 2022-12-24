<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        return [
            // 'year' => 'required|unique:our_storys',
            'title' => [
                'required',
                
            ],
            'short_description' => 'required',
            
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The Title field is required.',
            'short_description.required' => 'The Short Description field is required.',
            
            
        ];
    }
}
