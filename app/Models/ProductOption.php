<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'title_en', 'title_id',
        'option_en', 'option_id',
        'price',
        'description_en', 'description_id',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getTitleAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'id' ? $this->title_id : $this->title_en;
    }

    public function getOptionAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'id' ? $this->option_id : $this->option_en;
    }

    public function getDescriptionAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'id' ? $this->description_id : $this->description_en;
    }
}
