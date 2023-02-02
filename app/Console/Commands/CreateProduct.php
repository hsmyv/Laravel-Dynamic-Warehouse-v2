<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

use App\Models\Product;
class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:product {--product=}';

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
        $count = $this->option('product');
        $bar   = $this->output->createProgressBar($count);
        $bar->start();
        for ($i=0; $i < $count ; $i++) {
            $name = Str::random(5);
            $price = random_int(0,999);
            $sell  = random_int(0,999);
            $cat_id = random_int(2,3);
            $status = random_int(0,1);
            $quantity = random_int(0,999);

            Product::create([
                'name' => $name,
                'price' => $price,
                'sell' => $sell,
                'category_id' => $cat_id,
                'status'    => $status,
                'quantity'  => $quantity
            ]);
            $bar->advance();
        }
        $bar->finish();
        $this->info($count. 'Products(s) successfully created');
        return 0;
    }
}
