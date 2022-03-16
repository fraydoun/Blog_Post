<?php

namespace Fraidoon\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pishran\LaravelPersianSlug\HasPersianSlug;
use Spatie\Sluggable\SlugOptions;


class BlogPost extends Model
{
    use HasFactory;
    use HasPersianSlug;

    protected $fillable = ['blog_category_id','title', 'short_content','content', 'admin_id', 'photo','view_counter','tags','slug','slug_title'];

    public function blogCategory(){
    	return $this->belongsTo(BlogCategory::class);
    }

    public function blogComments(){
        return $this->hasMany(BlogComment::class);
    }

    public function admin(){
    	return $this->belongsTo(\App\Models\Admin::class);
    }
   
    
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('slug_title')
            ->saveSlugsTo('slug');
    }
    

}
