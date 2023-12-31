<?php

namespace App\Http\Modules\Categories\Models;

use App\Http\Modules\Products\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function products():HasMany
    {
        return $this->hasMany(Product::class);

    }
}
