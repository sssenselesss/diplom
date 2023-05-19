@extends('layout.index')
@section('page_title','Создать задание')

@section('content')
    <div class="addOrder addArticle attach mt150 ">
        <h2 class="h2-title mb60">Восстановить пароль</h2>
        <div class="wrapper">
            <form action="{{route('reset.post')}}" class="addArtcile-form" method="post" >
                @csrf
                <div class="field">
                    <label for="email">Введите почту аккаунта от которого хотите восстановить пароль</label>
                    <input type="email" name="email" id="email" class="addArticle__input"  />
                </div>
                @error('email') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror


                <button class="button ">Отправить</button>

            </form>
        </div>
    </div>
@endsection
