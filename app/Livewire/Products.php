<?php

namespace App\Livewire;

use App\Models\Expense;
use App\Models\Income;
use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
//    public $income;
    public $orderProducts = [];
    public $allProducts = [];

    public function mount(Income $income, Expense $expense)
    {

        $this->allProducts = Product::all();

        if ($income->exists) {
            foreach ($income->products as $product) {
                $this->orderProducts[] = ['product_id' => $product->id, 'measure' => $product->pivot->quantity];
            }
        }elseif ($expense->exists)
            foreach ($expense->products as $product) {
                $this->orderProducts[] = ['product_id' => $product->id, 'measure' => $product->pivot->quantity];
            }
        else {
            $this->orderProducts[] = ['product_id' => '', 'measure' => 1];
        }

    }

    public function addProduct()
    {

        $this->orderProducts[] = ['product_id'=>'','measure'=>1];

    }

    public function removeProduct($index)
    {

        unset($this->orderProducts[$index]);
        $this->orderProducts = array_values($this->orderProducts);

    }

    public function render()
    {

//        dd($this->orderProducts);
        return view('livewire.products');

    }
}
