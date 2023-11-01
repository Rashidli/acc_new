<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchases';
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price', 'total_amount', 'unit','edv');
    }

    public function bank_payments()
    {
        return $this->hasMany(BankPayment::class);
    }
}
