<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'title',
        'content',
        'image',
        'users_id',
        'categories_id',
    ];

    /**
     * The user() function returns the user that owns the post
     * 
     * @return A collection of all the comments that belong to the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo(Categorie::class, 'categories_id', 'id');
    }
}
