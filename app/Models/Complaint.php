<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'task_id',
        'status',
        'category_id'
    ];

    public function task(){
        return $this->hasOne(Task::class,'id','task_id')->first();
    }
    public function user(){
        return $this->hasOne(User::class,'id','user_id')->first();
    }
    public function category(){
        return $this->hasOne(ComplaintCategotirs::class,'id','category_id')->first();
    }

}
