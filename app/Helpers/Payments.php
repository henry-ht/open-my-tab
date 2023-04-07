
<?php
require_once 'payu-php-sdk-4.5.7/lib/PayU.php';
namespace App\Helpers;


class Payments {
    protected $baseUri;
    protected $apiKey;
    protected $secret;
    protected $baseCurrency;
    protected $merchantId;
    protected $accountId;

    public function __construct()
    {
        $this->baseUri = config('services.payu.base_uri');
        $this->apiKey = config('services.payu.api_key');
        $this->secret = config('services.payu.secret');
        $this->baseCurrency = config('services.payu.base_currency');
        $this->merchantId = config('services.payu.merchant_id');
        $this->accountId = config('services.payu.account_id');
    }
}
