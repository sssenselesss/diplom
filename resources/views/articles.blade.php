@extends('layout.index')
@section('page_title','Полезные статьи')

@section('content')
    <div class="articles">
        <h2 class="h2-title">Полезные статьи</h2>
        <div class="wrapper">
            @auth()
                @if(\Illuminate\Support\Facades\Auth::user()->role ==='admin')
                    <div class="add-articles__container">
                        <a href="{{route('articleCreate')}}" class="add-articles__button">Добавить статью</a>
                    </div>

                @endif
            @endauth


            <div class="articles-container">
                @if(count($articles)!==0)
                    @foreach($articles as $article)
                        <a href="{{route('singleArticle',$article->id)}}" class="article">
                            <div class="article-image">
                                <img src="{{$article->getImageUrlAttributeArticle()}}" alt="">
                            </div>
                            <div class="article-date">{{$article->created_at}}</div>
                            <div class="article-date">{{$article->title}}</div>

                            <div class="article-category">{{$article->category()->name}}</div>

                        </a>
                    @endforeach
                    @else
                    пока нет статей
                    @endif



            </div>

        </div>
    </div>
@endsection
