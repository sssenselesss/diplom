@extends('layout.index')
@section('page_title','Все задания')

@section('content')
    <div class="admin mt90">
        <h2 class="h2-title mb60">Админ панель</h2>
        <div class="admin-wrapper">
            <div class="admin-select-bar">
                <div class="select-item "><a href="{{route('adminAllUsers')}}">Все пользователи</a> </div>
                <div class="select-item active"><a href="{{route('adminAllTasks')}}">Задания</a></div>
                <div class="select-item "><a href="{{route('adminAllCategories')}}">Все категории</a></div>
                <div class="select-item "><a href="{{route('adminAllComplaints')}}">Жалобы</a> </div>

            </div>

            <div class="admin-search">
                <form action="" class="admin-search__form" method="get">
                    @csrf
                    <div class="search-div">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        <input type="text" placeholder="Поиск по имени или id" class="hidden" id="search" name="search">
                    </div>
                    <button class="button search-btn">Поиск</button>
                </form>

            </div>

            <div class="admin-orders">
            @if(count($tasks)!==0)
                @foreach($tasks as $task)
                    <div class="admin-order">
                        <div class="admin-order__up">
                            <a href="{{route('singleTask',$task->id)}}" class="admin-order__title-price">
                                <div class="admin-order__title">{{$task->title}}</div>
                                <div class="admin-order__price">{{$task->money()}}  </div>
                            </a>
                            <div class="admin-order__address">{{$task->place}}</div>
                        </div>

                        <div class="admin-order__down">
                            <div class="admin-order__image">
                                @if($task->author()->image === null)
                                    <img src="{{asset('public/assets/avatars/default.png')}}" alt="">

                                @else
                                    <img src="{{$task->author()->getImageUrlAttribute()}}" alt="">

                                @endif
                            </div>
                            <div class="admin-order__name-rate">
                                <a href="{{route('profile',$task->author_id)}}" class="admin-order__name">{{$task->author()->name}}</a>
                                <div class="admin-order__rate">Отзвывы: {{$task->author()->feedback($task->author_id)}} </div>

                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                Пока нет заданий
                @endif




            </div>





            <div class="padding-container">

                {{$tasks->links()}}

            </div>
        </div>
    </div>
@endsection
