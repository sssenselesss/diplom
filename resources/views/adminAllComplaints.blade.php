@extends('layout.index')
@section('page_title','Все пользователи')

@section('content')
    <div class="admin mt90 allCategories">
        <h2 class="h2-title mb60">Админ панель</h2>
        <div class="admin-wrapper">
            <div class="admin-select-bar ">
                <div class="select-item "><a href="{{route('adminAllUsers')}}">Все пользователи</a></div>
                <div class="select-item"><a href="{{route('adminAllTasks')}}">Задания</a></div>
                <div class="select-item "><a href="{{route('adminAllCategories')}}">Все категории</a></div>

                <div class="select-item active"><a href="{{route('adminAllComplaints')}}">Жалобы</a> </div>
            </div>




            <div class="admin-users__container mt30">

                @if(count($comps) === 0 )
                    <span class="null"> Жалоб пока нет</span>
                    @else

                    @foreach($comps as $comp)
                        <div class="admin-order">
                            <div class="admin-order__up">
                                <a class="admin-order__title-price">
                                    <div class="admin-order__title">{{$comp->category()->name}}</div>

                                </a>

                            </div>

                            <div class="admin-order__up" style="margin-top: 15px">
                                <a href="{{route('singleTask',$comp->task_id)}}" class="admin-order__title-price">
                                    <div class="admin-order__title">{{$comp->task()->title}}</div>

                                </a>

                                <div class="" >{{$comp->task()->description}}</div>

                            </div>

                            <div class="admin-order__down">
                                <div class="admin-order__image">
                                    @if($comp->user()->image === null)
                                        <img src="{{asset('public/assets/avatars/default.png')}}" alt="">

                                    @else
                                        <img src="{{$comp->user()->getImageUrlAttribute()}}" alt="">

                                    @endif
                                </div>
                                <div class="admin-order__name-rate">
                                    <a href="{{route('profile',$comp->user_id)}}" class="admin-order__name">{{$comp->user()->name}}</a>
                                    <div class="admin-order__rate">Отзвывы: 14 </div>

                                </div>
                            </div>

                            <div class="comp-btns">
                                <a href="{{route('blockUser',$comp)}}" title="При блокировке пользователя удалятся все задания,созданные им" class="comp-btn">Заблокировать</a>
                                <a href="{{route('deleteTask',$comp)}}" class="comp-btn">Удалить задание</a>
                                <a href="{{route('cancelComplaint',$comp)}}" class="comp-btn red-btn">Отклонить</a>
                            </div>
                        </div>

                    @endforeach

                @endif



            </div>

            <div class="padding-container">

                {{$comps->links()}}

            </div>

        </div>
    </div>

@endsection
