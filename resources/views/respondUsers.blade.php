@extends('layout.index')
@section('page_title','Откликнулось')

@section('content')
    <div class="respond-users mt90">
        <h2 class="h2-title mb60">Откликнулись</h2>
        <div class="wrapper ">

            @if(count($resUsers) !==0)
                @foreach($resUsers as $user)

                    <div class="respond-user">
                        {{--                {{route('profile',$task->author_id)}}--}}
                        <a href="{{route('profile',$user->executor()->id)}}" class="respond-upper">
                            <div class="respond-image">
                                @if($user->executor()->image === null)
                                    <img src="{{asset('public/assets/avatars/default.png')}}" alt="123">
                                @else
                                    <img src="{{$user->executor()->getImageUrlAttribute()}}" alt="123">

                                @endif
                            </div>
                            <div class="respond-name">{{$user->executor()->name}}</div>
                        </a>
                        <div class="respond-btns">
                            <a href="{{route('respondAccept',$user)}}" class="respond-button accept">Принять</a>
                            <a href="{{route('respondCancel',$user->id)}}" class="respond-button cancel" >Отклонить</a>
                        </div>
                    </div>

                @endforeach
                @else
                Пока никто не откликнулся
                @endif





        </div>
    </div>
@endsection
