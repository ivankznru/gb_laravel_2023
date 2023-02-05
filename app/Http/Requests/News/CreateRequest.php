<?php

declare(strict_types=1);

namespace App\Http\Requests\News;

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
        $tableNameCategory = (new Category())->getTable();
        return [
            'title' => 'required|min:3|max:20|unique:'.$tableNameCategory.',title',
            'text' => 'required|min:3',
            'author' => ['nullable', 'string', 'min:2', 'max:30'],
            'status' => ['required', new Enum(NewsStatus::class)],
            'image' => ['sometimes'],
            'isPrivate' => 'sometimes|in:1',
            'category_id' => "required|exists:{$tableNameCategory},id"
        ];
    }


    public function getCategoryIds(): array
    {
        return (array) $this->validated('category_id');
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
