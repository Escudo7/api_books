<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBook extends FormRequest
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
        $currentYear = date("Y");
        return [
            'name' => 'required|max:100',
            'year_publication' => "required|max: {$currentYear}",
            'authors' => 'required|array',
            'authors.*' => 'integer|exists:authors,id,deleted_at,NULL',
            'genres' => 'required|array',
            'genres.*' => 'integer|exists:genres,id,deleted_at,NULL'
        ];
    }
}
