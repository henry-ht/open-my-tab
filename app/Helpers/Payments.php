<?php
namespace App\Helpers;


require_once 'payu-php-sdk-4.5.7/lib/PayU.php';

class Payments {
    protected $baseUri;
    protected $apiKey;
    protected $secret;
    protected $baseCurrency;
    protected $merchantId;
    protected $accountId;
    protected $parameters = [];

    public function __construct()
    {
        $this->baseUri = config('services.payu.base_uri');
        $this->apiKey = config('services.payu.api_key');
        $this->secret = config('services.payu.secret');
        $this->baseCurrency = config('services.payu.base_currency');
        $this->merchantId = config('services.payu.merchant_id');
        $this->accountId = config('services.payu.account_id');

        \PayU::$apiKey = $this->apiKey;
        \PayU::$apiLogin = $this->secret;
        \PayU::$merchantId = $this->merchantId;
        \PayU::$language = \SupportedLanguages::ES;
        \PayU::$isTest = true;

        \Environment::setPaymentsCustomUrl($this->baseUri);

        $this->parameters[\PayUParameters::USER_AGENT] = "Mozilla/5.0 (Windows NT 5.1; rv:18.0) Gecko/20100101 Firefox/18.0";
        $this->parameters[\PayUParameters::ACCOUNT_ID] = $this->accountId;
        $this->parameters[\PayUParameters::CURRENCY] = "COP";
    }

    public function creditCard(Array $data)
    {
        $this->parameters[\PayUParameters::PAYER_NAME] = $data['payer_name'];
        $this->parameters[\PayUParameters::PAYER_EMAIL] = $data['payer_email'];
        $this->parameters[\PayUParameters::CREDIT_CARD_NUMBER] = $data['card_number'];
        $this->parameters[\PayUParameters::CREDIT_CARD_EXPIRATION_DATE] = $data['card_date'];
        $this->parameters[\PayUParameters::CREDIT_CARD_SECURITY_CODE] = $data['card_code'];
        $this->parameters[\PayUParameters::PAYMENT_METHOD] = $data['card_name'];
        $this->parameters[\PayUParameters::INSTALLMENTS_NUMBER] = "1";
        $this->parameters[\PayUParameters::COUNTRY] = \PayUCountries::CO;
    }

    public function reference(String $reference, String $description){
        $this->parameters[\PayUParameters::REFERENCE_CODE] = $reference;
        $this->parameters[\PayUParameters::DESCRIPTION] = $description;
    }

    public function value(String $value){
        $this->parameters[\PayUParameters::VALUE] = $value;
    }


    public function purchase(){
        try {
            $response = \PayUPayments::doAuthorizationAndCapture($this->parameters);
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }




}
