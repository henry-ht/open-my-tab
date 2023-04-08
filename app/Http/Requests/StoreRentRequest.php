<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardNumber;

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
            'payment_method.*'              => 'required|in:payer_name,payer_email,card_number,card_date,card_code,card_name',
            'payment_method.payer_name'     => 'required|string|max:120',
            'payment_method.payer_email'    => 'required|email',
            'payment_method.card_number'    => ['required', new CardNumber],
            'payment_method.card_date'      => 'required|date_format:Y/m|after:'.Carbon::now()->format('Y/m'),
            'payment_method.card_code'      => ['required', 'min:3', new CardCvc($this->payment_method['card_number'])],
            'payment_method.card_name'      => 'required|in:VISA,MASTERCARD,DINERS',
            'product_ids'       => 'required|array|min:1',
            'product_ids.*'     => 'required|integer|exists:products,id',
            'start_date'        => 'required|date_format:Y-m-d H:i|before_or_equal:end_date',
            'end_date'          => 'required|date_format:Y-m-d H:i|after_or_equal:start_date',
        ];
    }
}
