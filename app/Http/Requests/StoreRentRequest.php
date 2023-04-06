<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreRentRequest extends FormRequest
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
            'product_ids'   => 'required|array|min:1',
            'product_ids.*' => 'required|integer|exists:products,id',
            'start_date'    => 'required|date_format:Y-m-d H:i|before_or_equal:end_date',
            'end_date'      => 'required|date_format:Y-m-d H:i|after_or_equal:start_date',
        ];
    }
}
