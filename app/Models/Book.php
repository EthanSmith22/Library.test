<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
        protected $fillable = [
        'title',
        'author_id',
        'isbn',
        'publisher', 
        'language',
        'pages', 
        'edition', 
        'cover_image', 
        'released_date', 
        'description',
        ];

        public function author()
        {
            return $this->belongsTo(Author::class);
        }

        public function genres()
        {
            return $this->belongsToMany(Genre::class, 'book_genre');
        }

        public function copies()
        {
            return $this->hasMany(BookCopy::class);
        }
}
