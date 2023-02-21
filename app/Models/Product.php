<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // protected $fillable=[
    //     'name',
    //     'price',
    //     'sell',
    //     'category_id',
    //     'warehouse_id',
    //     'quantity',
    //     'status',
    // ];

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault([
            'name' => 'Deleted Category'
        ]);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class)->withDefault([
            'name' => 'Deleted Warehouse'
        ]);
    }
}
