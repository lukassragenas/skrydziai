<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ContactFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject' => 'required|max: 255',
            'email' => 'required|email|max: 255',
            'content' => 'required',
        ];
    }

    public function messages(){
        return [
            'required' => 'The :attribute field is required.',
            'email' => 'The :attribute must be a valid :attribute address'
        ];
    }
}
