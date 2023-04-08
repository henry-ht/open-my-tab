<?php

namespace App\Console\Commands;

use App\Helpers\Payments;
use App\Models\Rent;
use App\Models\Test;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakePayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'pagos pendientes a payu';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $rentPending = Rent::where('order_state', 'pending')->withSum('productRent', 'price')->get();
        foreach ($rentPending as $key => $rent) {
            $payments = new Payments();

            $payments->creditCard((array)json_decode($rent->payment_method));
            $payments->reference($rent->reference, 'payment test '.$rent->reference);
            $payments->value($rent->product_rent_sum_price);
            $purchase = $payments->purchase();

            if (!empty($purchase)) {
                if(!empty($purchase->code)){
                    if($purchase->code == "SUCCESS"){
                        if($purchase->transactionResponse->state == "APPROVED"){
                            $rent->payment_status = $purchase->transactionResponse->state;
                            $rent->payu_order_id = $purchase->transactionResponse->orderId;
                            $rent->order_state = 'active';
                            //user notification
                        }else{
                            $rent->payment_status = 'DECLINED';
                            $rent->order_state = 'cancelled';
                        }
                    }
                }else{
                    $rent->order_state = 'cancelled';
                    $rent->payment_status = 'DECLINED';
                    //user notification
                }
                $rent->save();
            }

        }
    }
}
