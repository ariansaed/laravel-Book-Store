<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'slug', 'description', 'image'];
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
}
