<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'key_name',
        'value_en',
        'value_id',
        'section',
    ];

    public function getValueAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'id' ? $this->value_id : $this->value_en;
    }
}
