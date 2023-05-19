@extends('layout.index')
@section('page_title','Редактировать профиль')

@section('content')
    <div class="addOrder addArticle attach mt90">
        <h2 class="h2-title mb60">Редактировать профиль</h2>
        <div class="wrapper">
            <form action="{{route('updateProfile',$user)}}" class="addArtcile-form" method="post" enctype="multipart/form-data">
                @csrf
                <div class="field">
                    <label for="name">Ваше имя</label>
                    <input type="text" name="name" id="name" class="addArticle__input" value="{{$user->name}}"/>
                </div>
                @error('name') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror
                <div class="field">
                    <label for="email">email</label>
                    <input type="text" name="email" id="email" class="addArticle__input" value="{{$user->email}}"/>
                </div>
                @error('email') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror

                <div class="field">
                    <label for="phone_number">Номер телефона</label>
                    <input type="text" name="phone_number" id="phone_number" class="addArticle__input" value="{{$user->phone_number}}"/>
                </div>
                @error('phone_number') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror

                <div class="field">
                    <label for="city">Город</label>
                    <input type="text" name="city" id="city" class="addArticle__input" value="{{$user->city}}"/>
                </div>

                @error('city') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror



                @if($user->role === 'executor')
                    <div class="field">
                        <label for="experience">Опыт работы</label>
                        <textarea name="experience" id="experience" class="addArticle__text">{{$user->experience}}</textarea>
                    </div>
                    @error('experience') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror

                    <div class="field">
                        <label for="about">Расскажите о себе</label>
                        <textarea name="about" id="about" class="addArticle__text">{{$user->about}}</textarea>
                    </div>
                    @error('about') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror
                @endif

                <div class="field mb60">
                    <label for="file">Изображение</label>
                    <div class="file-attach">
                        Выберите изображение
                        <input type="file" class="addArtilce__input" name="image">
                    </div>
                </div>

                <button class="button" type="submit">Сохранить</button>

            </form>
        </div>
    </div>
@endsection
