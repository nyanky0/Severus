<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_id',
        'slug',
        'description_en',
        'description_id',
        'icon',
        'sort_order',
    ];

    public function products()
    {
        return $table = $this->hasMany(Product::class);
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
}
