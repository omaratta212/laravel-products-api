<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
