<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image_path',
        'is_published',
        'category_id'
    ];

    // relacion uno a muchos inversa

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //relacion muchos a muchos 
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
