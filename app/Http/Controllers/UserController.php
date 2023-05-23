<?php

namespace App\Http\Controllers;

use App\Mail\User\PasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Psy\Util\Str;

class UserController extends Controller
{
    public function editProfile(User $user){

        return view('editProfile',['user'=>$user]);
    }

    public function update(Request $request, User $user){

        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone_number'=>'required',
            'city'=>'required',
            'experience'=>'nullable|min:20',
            'about'=>'nullable|min:50',
            'image'=>'mimes:png,jpg,jpeg'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors())->withInput($request->all());
        }

        $validated = $validator->validated();


        if($request->file('image')){
            $request->validate(['image' => 'mimes:jpg,jpeg,png']);

            $image = $request->file('image')->store('public/assets/avatars');
            $validated['image'] = $image;
        }
        $user->update(['experience'=>$request->experience,'about'=>$request->about] + $validated);

        return redirect()->route('profile',$user->id)->with(['success'=>'Данные успешно изменены']);
    }

    public function reset(Request $request){

        $user = User::query()->where('email',$request['email']);
        if(is_null($user))return back()->with(['alert'=>'Пользователя с такой почтой не существует']);

        $password = \Illuminate\Support\Str::random(12);
        Mail::to($request['email'])->send(new PasswordMail($password));
        $user->update(['password'=> Hash::make($password) ]);
        return back()->with(['success'=>'Пароль  отправлен на указанную почту']);

    }


}
