<?php

namespace App\Http\Requests\API\Notes;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'required|string|min:10',
            'style' => 'required|string|in:danger,info,success,warning',
            'title' => 'nullable|string|max:50|min:4',
        ];
    }
}
