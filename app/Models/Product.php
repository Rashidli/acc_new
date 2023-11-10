<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'unit','code'];

    public function incomes()
    {
        return $this->belongsToMany(Income::class)->withPivot('quantity');
    }

    public function expenses()
    {
        return $this->belongsToMany(Expense::class)->withPivot('quantity');
    }

    public function purchases()
    {
        return $this->belongsToMany(Purchase::class)->withPivot('quantity','price','total_amount','unit','edv');
    }

    public function quotations()
    {
        return $this->belongsToMany(Quotation::class);
    }
}
