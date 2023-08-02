<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * The Book model represents a book entity in the database.
 *
 * This model extends the Laravel Eloquent `Model` class and uses the `HasFactory` trait.
 * It provides access to the 'books' table in the database and specifies the fillable attributes.
 */
class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title','author','image'
    ];
}
