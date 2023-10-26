<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuEditRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'url' => 'nullable',
            'icon' => 'nullable',
            'menu_order' => 'nullable',
            'parent_menu' => 'nullable',
            'permissions'=> 'nullable',
            'description' => 'nullable',
        ];
    }
}
