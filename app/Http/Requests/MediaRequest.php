<?php

namespace RedCrown\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
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
            'media' => 'required|image|max:5000',
            'filename' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'media.image' => 'Вы должны выбрать изображение',
            'media.required' => 'Вы должны выбрать изображение',
            'filename.required' => 'Вы не указали название изображения'
        ];
    }

    protected function formatErrors(Validator $validator)
    {
        return $validator->errors()->all('<li>:message</li>');
    }
}
