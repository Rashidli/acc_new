<?php

namespace App\Livewire;

use Livewire\Component;

class ProductSelect extends Component
{
    public $selected = '';

    public $series = [
        'Wanda Vision',
        'Money Heist',
        'Lucifer',
        'Stranger Things',
    ];

    public function render()
    {
        return view('livewire.product-select');
    }
}
