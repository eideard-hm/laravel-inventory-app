<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    //relación de muchos a muchos
    function product()
    {
        return $this->belongsToMany(Product::class, 'invoice_details')
            ->withPivot('price', 'quantity');
    }
}
