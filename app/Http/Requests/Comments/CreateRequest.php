<?php

declare(strict_types=1);

namespace App\Http\Requests\Comments;

use App\Enums\NewsStatus;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    public function rules(): array
    {

        return [
            'title' => 'required|min:3',
            'text'=> 'required|min:3',
        ];
    }


    public function attributes(): array
    {
        return [
            'title' => 'наименование',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'Нужно заполнить поле :attribute',
        ];
    }
}
