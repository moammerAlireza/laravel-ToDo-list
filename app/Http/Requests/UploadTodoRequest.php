<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadTodoRequest extends FormRequest
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
            'todo_file'=>'file|required|mimes:jpg,png,pdf|max:2048'
        ];
    }
}
