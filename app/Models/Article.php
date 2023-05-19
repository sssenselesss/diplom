<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'category_id',
        'text',
        'image',

        'views_count'
    ];

    public function getImageUrlAttributeArticle(){
        return asset('public'.Storage::url($this->image));
    }

    public function category()
    {
        return $this->hasOne(ArticleCategory::class, 'id', 'category_id')->first();
    }


}
