<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
    'name',
    'email',
    'phone',
    'address',
    'joined_date',
    'password',
    ];
    protected $hidden = [
    'password',
    ];
    public function borrowRecords()
    {
        return $this->hasMany(BorrowRecord::class);
    }
}
