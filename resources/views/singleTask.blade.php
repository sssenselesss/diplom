@extends('layout.index')
@section('page_title',$task->title)

@section('content')
    <div class="modal">

        <div class="modal-wrapper">
            <div class="modal-close close-black">
                <i class="fa fa-times" aria-hidden="true"></i>
            </div>

            <h5 style="margin-bottom: 20px">Что именно вам кажется недопустимым в этом материале?</h5>

            <form action="{{route('sendComplaint')}}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{$task->author_id}}">
                <input type="hidden" name="task_id" value="{{$task->id}}">
                <select name="category_id" id="" class="select-form">
                    <option value="">--- Выберите категорию ---</option>
                    @foreach($compCategories as $compCat)
                        <option value="{{$compCat->id}}">{{$compCat->name}}</option>
                    @endforeach


                </select>
                @error('category_id') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror

                <button class="button">Отправить жалобу</button>
            </form>
        </div>
    </div>

    <div class="single">
        <div class="wrapper">
            <h2 class="mt90  h2-title">{{$task->title}}</h2>

            <div class="time-category">
                <div class="time-category__item">Создано {{$task->created_at}}</div>

                <div class="time-category__item">{{$task->category()->name}}</div>

                @auth()
                    @if($task->author_id === auth()->user()->id)
                        <a href="{{route('respondUsers',$task->id)}}" class="time-category__item cursor">
                            Откликнулось
                            @if($respond_count === null)
                                (0)
                            @else
                           ({{count( $respond_count)}})

                            @endif
                        </a>

                    @endif
                @endauth

                <div class="time-category__item open_modal_comp">Пожаловаться</div>

            </div>


            <div class="single-content">


                @if($task->image !== null)
                    <div class="single-image">
                        <img src="{{$task->getImage()}}"
                             alt="123">
                    </div>

                @endif


                <div class="single-text">
                    <div>
                        <b>Бюджет</b>
                        <span> {{$task->money()}} </span>
                    </div>
                    <div>
                        <b>Нужно</b>
                        <span>{{$task->description}}</span>
                    </div>

                    <div>
                        <b>Дополнительно</b>
                        <span>{{$task->option}}</span>
                    </div>


                    <div>
                        <b>Место</b>
                        <span> {{$task->place}}</span>
                    </div>

                </div>

            </div>

            <div class="single-author">
                <div class="author-text">Заказчик задания</div>
                <a href="{{route('profile',$task->author_id)}}" class="author-image__name">
                    <div class="author-image">
                        @if($task->author()->image === null)
                            <img src="{{asset('public/assets/avatars/default.png')}}" alt="Фото проифиля">
                        @else
                            <img src="{{$task->author()->getImageUrlAttribute()}}" alt="Фото профиля">

                        @endif
                    </div>
                    <div class="author-name__rate">
                        <span class="author-name">{{$task->author()->name}}</span>
                        <span class="author-rate">Отзвывы: {{$task->author()->feedback($task->author_id)}} </span>
                    </div>
                </a>
            </div>

            @auth()
                @if(auth()->user()->id === $task->author_id || !is_null($executor))
                    <div class="single-contacts">
                        <span class="contact">Телефон: {{$task->author()->phone_number}}</span>
                        <span class="contact">email: {{$task->author()->email}}</span>
                    </div>

                @endif
            @endauth


            @auth()
                <div class="single-btns">
                    @if($task->author_id !== auth()->user()->id)
                        @if(auth()->user()->role !== 'executor' and auth()->user()->role != 'admin')
                            <a href="{{route('becomeExecutor')}}" class="single-button">Откликнутся</a>
                        @else
                        @endif

                        @if($task->author_id !== auth()->user()->id)
                            @if($task_app ===null)
                                <a href="{{route('respond',$task)}}" class="single-button">Откликнутся</a>

                            @endif
                        @endif

                    @endif



                    @if(auth()->user()->id === $task->author_id or auth()->user()->role ==='admin')
                        <a href="{{route('updateTask',$task->id)}}" class="single-button">Редактировать</a>
                        <a href="{{route('delete.post',$task->id)}}" class="single-button red-btn">Удалить</a>
                    @endif

                </div>
            @endauth


        </div>
    </div>
@endsection
