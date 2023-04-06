<?php

namespace App\Listeners;

use App\Models\Test;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TransactionInitiatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $transactionId = $event->transaction->transactionId;

        Test::create([
            'data' => "init"
        ]);
    }
}
