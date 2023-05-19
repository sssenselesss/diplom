<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'customer_id',
        'executor_id',
        'status'
    ];

    public function executor(){
        return $this->hasOne(User::class,'id','executor_id')->first();
    }
    public function customer(){
        return $this->hasOne(User::class,'id','customer_id')->first();
    }
    public function task(){
        return $this->hasOne(Task::class,'id','task_id')->first();
    }
}
