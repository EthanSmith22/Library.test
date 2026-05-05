<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCopy extends Model
{
    protected $fillable = [
    'book_id', 
    'book_stand_id', 
    'accession_no', 
    'condition', 
    'status',
    ];
        public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function stand()
    {
        return $this->belongsTo(BookStand::class, 'book_stand_id');
    }

    public function borrowRecords()
    {
        return $this->hasMany(BorrowRecord::class);
    }
}
