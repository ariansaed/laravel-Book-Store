<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class product extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'category_id',
        'slug',
        'description',
        'image',
        'price',
        'stock',
        'user_id',
        'slider',
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public static function UniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;
        while (self::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        return $slug;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(category::class);
    }
}
