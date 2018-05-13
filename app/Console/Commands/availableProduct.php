<?php
/**
 * Created by PhpStorm.
 * User: alaa.shehadeh
 * Date: 5/13/2018
 * Time: 9:13 AM
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Http\Controllers\productController;

class availableProduct extends Command
{
    protected $signature = "availableProduct {startDate} {endDate} {travelersNumber}";

    public function handle(productController $productController)
    {
        $startDate = $this->argument('startDate');
        $endDate = $this->argument('endDate');
        $travelersNumber = $this->argument('travelersNumber');

        $output = $productController->getProducts($startDate,$endDate,$travelersNumber);
        echo $output;
    }
}