<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Region extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //Auth::user()->hasAnyRole(['kingpin']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'required|string|max:50',
            'description'=> 'required|string|max:255',
            'contact_number'=> 'required|max:20',
            'province'=> 'required|string|max:100',
            'address'=> 'string',
            'coordinates'=> '',
        ];
    }
}
