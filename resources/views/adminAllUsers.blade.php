@extends('layout.index')
@section('page_title','Все пользователи')

@section('content')
    <div class="admin mt90">
        <h2 class="h2-title mb60">Админ панель</h2>
        <div class="admin-wrapper">
            <div class="admin-select-bar">
                <div class="select-item active"><a href="{{route('adminAllUsers')}}">Все пользователи</a> </div>
                <div class="select-item"><a href="{{route('adminAllTasks')}}">Задания</a></div>
                <div class="select-item "><a href="{{route('adminAllCategories')}}">Все категории</a></div>

                <div class="select-item "><a href="{{route('adminAllComplaints')}}">Жалобы</a> </div>

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
                        <div class="user-image">
                            @if($user->image === null)
                                <img src="{{asset('public/assets/avatars/default.png')}}" alt="">
                                @else
                                <img src="{{$user->getImageUrlAttribute()}}" alt="Фото профиля">

                            @endif
                        </div>

                        <div class="user-info">
                            <span class="user-name">{{$user->name}} ({{$user->id}})</span>
                            <span class="user-email">{{$user->email}}</span>
                            <span class="user-status">Статус: @if($user->status ==='active')Активный @else Заблокирован@endif</span>
                            <span class="user-datereg">Зарегистрирован: {{$user->created_at}}</span>
                        </div>

                        <div class="user-button">Заблокировать</div>
                    </div>
                @endforeach


            </div>

            <div class="padding-container">

                {{$users->links()}}

            </div>
        </div>
    </div>

@endsection
