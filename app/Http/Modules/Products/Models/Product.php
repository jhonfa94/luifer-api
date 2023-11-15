<?php

namespace App\Http\Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "price",
        "category_id",
        "mark_id",
    ];

    public function mark():BelongsTo
    {
       return $this->belongsTo(Mark::class);
    }
}
