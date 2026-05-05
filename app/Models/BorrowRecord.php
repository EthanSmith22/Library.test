<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowRecord extends Model
{
    protected $fillable = [
    'member_id',
    'book_copy_id',
    'borrow_date',
    'due_date',
    'return_date',
    ];
        public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function copy()
    {
        return $this->belongsTo(BookCopy::class, 'book_copy_id');
    }
}
