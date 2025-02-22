<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaginatedQueryBuilderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'filter' => 'array', // filter is an array
            'filter.name' => 'string|nullable', // individual filter values are strings or nulls

            'sort' => 'string',
            'fields' => 'string',
            'include' => 'string',

            'per_page' => 'integer|min:1|max:50',
            'page' => 'integer|min:1',
        ];
    }

    public function validated($key = null, $default = null)
    {
        // Override the validated method to perform additional processing
        // Remove any empty values from the 'filter' or 'sort' arrays

        $validated = parent::validated();

        // Remove empty values from filter array
        $validated['filter'] = array_filter($validated['filter']);

        // Remove empty values from sort array
        $validated['sort'] = array_filter($validated['sort']);

        return $validated;
    }

    public function queryParameters(): array
    {
        return [
            'filter' => [
                'description' => 'Filter by the field. Use filter[fieldName]=value for filtering.',
                'example' => '{"name:John", "email:john@example.com"}',
                'type' => 'object',
            ],
            'filter.name' => [
                'description' => 'Filter by the name field.',
                'example' => '',
            ],
            'sort' => [
                'description' => "Comma-separated list of fields to sort by. Use -field for descending order. Defaults to '-created_at'",
                'example' => 'name,-created_at',
            ],
            'fields' => [
                'description' => 'Comma-separated list of fields to include in the response.',
                'example' => 'id,name,email',
            ],
            'include' => [
                'description' => 'Comma-separated list of related models to include in the response.',
                'example' => 'posts',
            ],
            'page' => [
                'description' => 'The page number.',
                'example' => 1,
            ],
            'per_page' => [
                'description' => 'The number of items per page.',
                'example' => 10,
            ],
        ];
    }
}
