<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookStand extends Model
{
    protected $fillable = [
    'code',
    'floor',
    'section',
    'description',
    ];
    public function copies()
    {
        return $this->hasMany(BookCopy::class);
    }
}
