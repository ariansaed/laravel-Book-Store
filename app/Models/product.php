<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
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
      protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => verta($this->$value)->format('Y/m/d H:i'),
        );
    }
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
    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
