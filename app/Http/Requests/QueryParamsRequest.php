<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class QueryParamsRequest
 *
 * @property array $filter An array of filters. Example: ["name:John", "status:active"]
 * @property array $sort An array of sort fields. Example: ["name", "-created_at"]
 * @property int $per_page The number of items per page. Example: 10
 * @property int $page The page number. Example: 1
 */
class QueryParamsRequest extends FormRequest
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
            'filter' => 'array',
            'filter.name' => 'string',

            'sort' => 'array',
            'sort.*' => 'string',

            'per_page' => 'integer|min:1|max:100',
            'page' => 'integer|min:1',
        ];
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validated($key = null, $default = null)
    {
        $validated = parent::validated();

        // Remove empty values from filter array
        $validated['filter'] = array_filter($validated['filter']);

        // Remove empty values from sort array
        $validated['sort'] = array_filter($validated['sort']);

        return $validated;
    }

    /**
     * Specify the query parameters for the Scribe documentation.
     *
     * @return array
     */
    public function queryParameters()
    {
        return [
            'filter' => [
                'description' => 'An array of filters.',
                'example' => '{"name:John", "status:active"}',
                'type' => 'object',
            ],
            'filter.name' => [
                'description' => 'An array of filters.',
                'example' => 'johs',
            ],
            'sort' => [
                'description' => 'An array of sort fields.',
                'example' => '["name", "-created_at"]',
                'type' => 'array',
            ],
            'per_page' => [
                'description' => 'The number of items per page.',
                'example' => 10,
                'type' => 'integer',
            ],
            'page' => [
                'description' => 'The page number.',
                'example' => 1,
                'type' => 'integer',
            ],
        ];
    }
}
