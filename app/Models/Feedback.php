<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'rate',
        'task_id',
        'executor_id',
        'customer_id',
        'text',
        'order_id'

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

    public function average($id){

        return Feedback::query()->where('executor_id','=',$id)->average('rate');
    }

    public function finished($id){
        return count(Application::query()->where('executor_id','=',$id)
            ->where('status','=','finished')->get());
    }
}
