@extends('layout.index')
@section('page_title','Все пользователи')

@section('content')
    <div class="admin mt90">
        <h2 class="h2-title mb60">Админ панель</h2>
        <div class="admin-wrapper">
            <div class="admin-select-bar">
                <div class="select-item active"><a href="{{route('adminAllUsers')}}">Все пользователи</a></div>
                <div class="select-item"><a href="{{route('adminAllTasks')}}">Задания</a></div>
                <div class="select-item "><a href="{{route('adminAllCategories')}}">Все категории</a></div>

                <div class="select-item "><a href="{{route('adminAllComplaints')}}">Жалобы</a></div>

            </div>

            <div class="admin-search">
                <form action="{{route('search')}}" class="admin-search__form" method="get">
                    @csrf
                    <div class="search-div">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        <input type="text" placeholder="Поиск по имени или id" class="hidden" id="search" name="search">
                    </div>
                    <button class="button search-btn">Поиск</button>
                </form>

            </div>

            <div class="admin-users__container">
                @foreach($users as $user)
                    <div class="user-item">
                        <a href="{{route('profile',$user->id)}}" class="user-image">
                            @if($user->image === null)
                                <img src="{{asset('public/assets/avatars/default.png')}}" alt="">
                            @else
                                <img src="{{$user->getImageUrlAttribute()}}" alt="Фото профиля">

                            @endif
                        </a>

                        <div class="user-info">
                            <span class="user-name"> <a href="{{route('profile',$user->id)}}">{{$user->name}} ({{$user->id}})</a></span>
                            <span class="user-email">{{$user->email}}</span>
                            <span class="user-status">Статус: @if($user->status ==='active')
                                    Активный
                                @else
                                    Заблокирован
                                @endif</span>
                            <span class="user-datereg">Зарегистрирован: {{$user->created_at}}</span>
                        </div>

                        @if($user->status ==='active')
                            <a href="{{route('blockUserAdmin',$user->id)}}" class="user-button">Заблокировать</a>
                        @else
                            <a href="{{route('unblockUserAdmin',$user->id)}}" class="user-button">Разблокировать</a>

                        @endif
                    </div>
                @endforeach


            </div>

            <div class="padding-container">

                {{$users->links()}}

            </div>
        </div>
    </div>

@endsection
