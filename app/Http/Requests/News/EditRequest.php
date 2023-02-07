<?php

namespace App\Http\Requests\News;

use App\Enums\NewsStatus;
use App\Models\Category;
use App\Models\News;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class EditRequest extends FormRequest
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
        $tableNameNews=(new News())->getTable();
        $tableNameCategory = (new Category())->getTable();
        return [
            'title' => 'required|min:3|max:20|unique:'.$tableNameNews.',title',
            'text' => 'required|min:3',
            'author' => ['nullable', 'string', 'min:2', 'max:30'],
            'status' => ['required', new Enum(NewsStatus::class)],
            'image' => ['sometimes'],
            'isPrivate' => 'sometimes|in:1',
            'category_id' => "required|exists:{$tableNameCategory},id"
        ];
    }
}
