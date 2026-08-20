<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name_en',
        'name_id',
        'slug',
        'description_en',
        'description_id',
        'price_idr',
        'price_usd',
        'tokopedia_url',
        'shopee_url',
        'image_path',
        'tip_size',
        'joint_type',
        'weight_oz',
        'tip',
        'ferrule',
        'is_featured',
        'is_active',
        'last_tokopedia_synced_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'price_idr' => 'decimal:2',
        'price_usd' => 'decimal:2',
        'last_tokopedia_synced_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function syncLogs()
    {
        return $this->hasMany(TokopediaSyncLog::class);
    }

    public function options()
    {
        return $this->hasMany(ProductOption::class)->orderBy('sort_order');
    }


    public function getNameAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'id' ? $this->name_id : $this->name_en;
    }

    public function getDescriptionAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'id' ? $this->description_id : $this->description_en;
    }

    public function getFormattedPriceIdrAttribute()
    {
        return 'Rp ' . number_format($this->price_idr, 0, ',', '.');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            if (str_starts_with($this->image_path, 'http')) {
                return $this->image_path;
            }
            return asset('storage/' . $this->image_path);
        }
        return asset('images/logo.png');
    }
}
