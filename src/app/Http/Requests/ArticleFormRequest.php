<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleFormRequest extends FormRequest
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
        // TODO reserve = 1　の場合に reserve_date, reserve_time の入力チェックを行いたい
        return [
            'title'   => 'required|max:191',
            'text'    => 'required|max:16383',
            'publish' => 'boolean',
            'reserve' => 'boolean',
        ];
    }
}
