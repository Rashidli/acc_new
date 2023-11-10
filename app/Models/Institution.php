<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;

    protected $fillable  = ['title', 'voen', 'bank_account_number', 'bank_code', 'bank_voen', 'swift', 'correspondent_account','contract'];
}
