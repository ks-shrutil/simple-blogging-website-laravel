<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'category_id', 'image', 'user_id'];

    public function user()
    {
        //one-to-many
        //It indicates that the blog model belongs to another model User.
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
