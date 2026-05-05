<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'name',
        'dob',
        'description',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}