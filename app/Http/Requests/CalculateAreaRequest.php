<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class CalculateAreaRequest extends FormRequest
{

    public function rules()
    {
        return [
            'n' => 'required|int|min:100|max:15000',
            'uuid' => 'required|string|max:50'
        ];
    }
}
