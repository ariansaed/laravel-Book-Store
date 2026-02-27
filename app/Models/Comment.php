<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = ['user_id', 'product_id', 'message'];
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => verta($this->$value)->format('Y/m/d H:i'),
        );
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(product::class);
    }
     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
