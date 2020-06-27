<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price', 'main_image', 'details',
    ];

    /**
     * @return BelongsTo
     * @var mixed
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getMainImageAttribute($value)
    {
        return $value ? Storage::disk('public')->url('products/images/') . $value : 'https://dummyimage.com/601x361';
    }
}
