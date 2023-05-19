@extends('layout.index')
@section('page_title',$article->title)

@section('content')
    <div class="singleArticle">
        <div class="singleArticle-image">
            <img src="{{$article->getImageUrlAttributeArticle()}}" alt="">
            <div class="black">{{$article->title}}</div>
        </div>

        <div class="singleArticle-content">
            {{$article->text}}
        </div>

        <div class="singleArticle-__author_date_views">
            <div class="singleArticle__info">Автор:
                Администратор
            </div>
            <div class="singleArticle__info">
                <span><i class="fa fa-calendar" aria-hidden="true"></i></span>
                {{$article->created_at}}
            </div>
            <div class="singleArticle__info">
                <span><i class="fa fa-eye" aria-hidden="true"></i></span>
                {{$article->views_count}}
            </div>


        </div>
        @auth()
            @if(\Illuminate\Support\Facades\Auth::user()->role === 'admin')
                <div class="singleArticle-btns">
                    <a href="{{route('editArticle',$article->id)}}" class="single-button">Редактирвать</a>
                    <a href="{{route('articleDelete',$article->id)}}" class="single-button red-btn">Удалить</a>

                </div>
            @endif
        @endauth

    </div>
@endsection
