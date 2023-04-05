<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class dataFaker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:faker {model} {--total=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $options    = $this->option();
        $totalItems = $options['total'] != NULL ? $options['total']:10;

        try {
            \App\Models\Rent::factory($totalItems)->create()->each(function ($rent) {
                \App\Models\ProductRent::factory(random_int(2,4))->forRent($rent)->create();
            });
            $this->info("data created");
        } catch (\Throwable $th) {
            $this->error('Error msj => '.$th->getMessage().' --//-- Linea => '.$th->getLine().' --//-- file_name => '.$th->getFile());
        }
    }
}
