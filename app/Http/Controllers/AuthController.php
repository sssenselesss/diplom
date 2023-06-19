<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:40',
            'email_reg' => 'required|email|unique:users,email',
            'phone_number' => 'required|min:11|max:11',
            'city' => 'required',
            'image' => 'mimes:png,jpg,webp',
            'password_reg' => 'required|min:6|same:re_password',
            're_password' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput($request->all());
        }

        $image = null;

        if ($request->file('image')) {
            $image = $request->file('image')->store('public/assets/avatars');
        }

        $user = User::query()->create(['email'=>$request['email_reg'],'image'
            => $image, 'password' => Hash::make($request['password_reg'])] + $validator->validated());

        Auth::login($user);

        return redirect()->route('main');
    }


    public function signin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        if (!Auth::attempt($validator->validated())) {
            return back()->withErrors(['invalid' => 'Неверные данные'])->withInput($request->all())->with(['alert'=>'Неверный email или пароль']);
        }

        return redirect()->route('main');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('main');
    }



}
