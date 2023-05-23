@extends('layout.index')
@section('page_title',$user->name)

@section('content')
    <div class="profile mt90">
        <div class="wrapper">
            <div class="profile-header">
                <div class="profile-image">
                    @if($user->image === null )
                        <img src="{{asset('public/assets/avatars/default.png')}}" alt="123">
                    @else
                        <img src="{{$user->getImageUrlAttribute()}}" alt="">

                    @endif
                </div>

                <div class="profile-info">
                    <div class="profile-name__age">

                        @if(\Illuminate\Support\Facades\Auth::check())
                            @if(auth()->user()->id === $user->id)
                                <span class="profile-name">Здравствуйте, {{$user->name}}!</span>
                            @else
                                <span class="profile-name"> {{$user->name}}</span>

                            @endif
                        @else
                            <span class="profile-name"> {{$user->name}}</span>

                        @endif


                        <span class="profile-age"> {{$user->city}}</span>
                    </div>

                    <div class="profile-rate-order">

                        @if($finished !== 0 )
                            <div class="profile-rate__item">
                                <span class="rate">{{$finished}} заданий</span>
                                <span>Выполнил</span>
                            </div>
                        @endif

                        @if($created !== 0 )
                            <div class="profile-rate__item">
                                <span class="rate">{{$created}} заданий </span>
                                <span>Создал</span>
                            </div>
                        @endif

                    </div>

                    @auth()
                        @if(\Illuminate\Support\Facades\Auth::user()->id === $user->id)
                            <a href="{{route('editProfile',$user->id)}}" class="change-profile">
                        <span class="icon-change">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </span>
                                Редактировать профиль
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            @if($user->role === 'executor')
                <div class="profile-about">
                    {{$user->about}}
                </div>
                <div class="profile-about">
                    {{$user->experience}}
                </div>

                <div class="types-of-works">
                    <h2>Виды выполняемых работ</h2>
                    <div class="types-wrapper">
                        @foreach($main as $m)
                            <div class="type-main__cat">
                                <span class="type-main">{{$m->name}}</span>
                                @foreach($categs as $categ)
                                    @if($categ->main_category === $m->id)
                                        <span class="type-sub">{{$categ->name}}</span>
                                    @endif
                                @endforeach


                            </div>
                        @endforeach


                    </div>
                </div>
            @endif

            @if(count($feedbacks)!== 0 )
                <div class="profile-feedbacks">
                    <div class="feedback-header">
                        <h2>Средняя оценка {{  number_format($average,1) }}</h2>
                        <div class="stars">
                            <div class="star">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="star">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="star">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="star">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="star">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    Всего отзывов: {{count($feedbacks)}}

                    <div class="feedbacks-wrapper">
                        @foreach($feedbacks as $feed)
                            <div class="feedback-item">
                                @auth()
                                    @if($feed->executor_id === \Illuminate\Support\Facades\Auth::user()->id or $feed->customer_id === \Illuminate\Support\Facades\Auth::user()->id or \Illuminate\Support\Facades\Auth::user()->role==='admin')
                                        <a title="Удалить отзыв" href="{{route('feedbackDestroy',$feed->id)}}"
                                           class="delete-feedback">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                @endauth

                                <div class="feedback-time__rate">
                            <span class="profile-feedback__rate">
                                Оценка {{$feed->rate}}/5
                            </span>
                                    <span class="profile-feedback__rate">
                                <span class="rate-time__icon">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </span>
                               {{$feed->created_at}}
                            </span>

                                </div>

                                <div class="profile-feedback__content">
                                    <span
                                        class="profile-feedback__order-title"> Задание <b>“{{$feed->task()->title}}”</b> выполнено</span>
                                    <span class="profile-feedback__order-text">{{$feed->text}}</span>

                                    @if($feed->executor_id === $user->id)
                                        <span class="profile-feedback__order-author">Заказчик <a
                                                href="{{route('profile',$feed->customer_id)}}">{{$feed->customer()->name}}</a></span>
                                    @else
                                        <span class="profile-feedback__order-author">Исполнитель <a
                                                href="{{route('profile',$feed->executor_id)}}">{{$feed->executor()->name}}</a></span>

                                    @endif


                                </div>
                            </div>

                        @endforeach
                    </div>


                </div>
            @else
                <div class="profile-feedbacks">
                    <div class="feedback-header">
                        <h2>Пока нет отзывов</h2>

                    </div>
                    <span>Отзывы появятся после того, как пользователь создаст или выполнит задание </span>


                </div>

            @endif


        </div>
    </div>
@endsection
