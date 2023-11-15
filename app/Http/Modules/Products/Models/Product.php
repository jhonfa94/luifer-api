<?php

namespace App\Http\Modules\Products\Models;

use App\Http\Modules\Categories\Models\Category;
use App\Http\Modules\Marks\Models\Mark;
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
