<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'description',
        'option',
        'place',
        'price',
        'date_start',
        'date_end',
        'image',
        'author_id',
        'status'
    ];

    public function author(){
        return $this->hasOne(User::class,'id','author_id')->first();
    }

    public function category(){
        return $this->hasOne(TaskCategory::class,'id','category_id')->first();
    }

    public function getImage(){
        return asset('public'.Storage::url($this->image));
    }

    public function money(){
        return number_format($this->price,'0',',',' ') . ' ₽';
    }

}
