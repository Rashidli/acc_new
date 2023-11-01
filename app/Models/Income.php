<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{

    use HasFactory;

    protected $table = 'incomes';
    protected $fillable = ['company','warehouse_name','date'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

}
