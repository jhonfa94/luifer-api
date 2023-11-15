<?php

namespace App\Http\Modules\Marks\Models;

use App\Http\Modules\Products\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = [
        "name"
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
