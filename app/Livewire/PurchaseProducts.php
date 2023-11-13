<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Purchase;
use Livewire\Component;

class PurchaseProducts extends Component
{
    public $orderProducts = [];

    public $totalAmountSum = 0;

    public $allProducts = [];

    public function mount(Purchase $purchase)
    {

        $this->allProducts = Product::all();
        $this->calculateTotalAmountSum();

        if ($purchase->exists) {

            foreach ($purchase->products as $product) {
                $this->orderProducts[] = ['product_id' => $product->id, 'measure' => $product->pivot->quantity,'price'=>$product->pivot->price,'edv'=>$product->pivot->edv,'total_amount'=>$product->pivot->total_amount,'unit'=>$product->pivot->unit];
            }
            $this->calculateTotalAmountSum();
        }
        else {
            $this->orderProducts[] = ['product_id' => '',  'unit' => '', 'measure' => 1, 'price' => '1', 'edv' => '', 'total_amount' => ''];
        }

    }


    public function getTotalAmount($index)
    {
        $measure = $this->orderProducts[$index]['measure'];
        $price = $this->orderProducts[$index]['price'];
        $edv = $this->orderProducts[$index]['edv'];

        if (!is_numeric($measure) || !is_numeric($price) || !is_numeric($edv)) {
            return 0;
        }

        $measure = (float) $measure;
        $price = (float) $price;
        $edv = (float) $edv;


        $totalAmount = ($measure * $price) +  $edv*($measure * $price);

        $this->orderProducts[$index]['total_amount'] = $totalAmount;
        $this->calculateTotalAmountSum();

    }

    private function calculateTotalAmountSum()
    {
        $this->totalAmountSum = array_sum(array_column($this->orderProducts, 'total_amount'));
    }

    public function addProduct()
    {

        $this->orderProducts[] = ['product_id' => '', 'unit' => '',  'measure' => 1, 'price' => '1', 'edv' => '', 'total_amount' => ''];
        $this->calculateTotalAmountSum();
    }

    public function removeProduct($index)
    {

        unset($this->orderProducts[$index]);
        $this->orderProducts = array_values($this->orderProducts);
        $this->calculateTotalAmountSum();
    }

    public function render()
    {

        return view('livewire.purchase-products');

    }

}
