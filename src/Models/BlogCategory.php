<?php

namespace Fraidoon\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    protected $fillable = ['title'];

    public function blogPosts(){
    	return $this->hasMany(BlogPost::class);
    }
}
