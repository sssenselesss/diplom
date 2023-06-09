<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'name',
        'email',
        'phone_number',
        'city',
        'image',
        'password',
        'role',
        'status',
        'experience',
        'about'
    ];

    public function getImageUrlAttribute(){
        return asset('public'.Storage::url($this->image));
    }

    public function feedback($id){
        return count(Feedback::query()->where('executor_id',$id)->get());
    }


}
