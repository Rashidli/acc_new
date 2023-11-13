<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankPayment extends Model
{

    use HasFactory, SoftDeletes;
    protected $fillable = ['electron_invoice','debet','credit','voen','date','company','payment_type','payment_amount','bank','purchase_id'];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

}
