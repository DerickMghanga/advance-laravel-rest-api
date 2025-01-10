<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $casts = [
        'body' => 'array' // laravel automatically converts array to json and back
    ];

    public function getTitleUpperCaseAttribute() // Accessor
    // retrieves the post title in Uppercase
    {
        return strtoupper($this->title);
    }

    public function setTitleAttribute($value)  // Mutator\
    // changes the title of the Post to the input given
    {
        $this->attributes['title'] = strtolower($value);
    }

    public function comments()  // table relationship 
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function users()  // table relationship via the pivot table
    {
        return $this->belongsToMany(User::class, 'post_user', 'post_id', 'user_id');
    }
}
