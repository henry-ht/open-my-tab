<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class GetRentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('is_admin') || Gate::allows('is_user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'status'        => 'sometimes|required|in:pending,active,complete,cancelled',
            'start_date'    => 'sometimes|required|date_format:Y-m-d|before_or_equal:end_date',
            'end_date'      => 'sometimes|required|date_format:Y-m-d|after_or_equal:start_date',
            'product_id'    => 'sometimes|required|integer|exists:products,id',
        ];
    }
}
