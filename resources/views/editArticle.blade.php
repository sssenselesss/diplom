@extends('layout.index')
@section('page_title','Редактировать статью')

@section('content')
    <div class="addArticle attach mt90">
        <h2 class="h2-title mb60">Редактировать статью</h2>
        <div class="wrapper">
            <form action="{{route('editArticle.post',$article)}}" class="addArtcile-form" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="field">
                    <label for="title">Заголовок</label>
                    <input name="title" id="title" class="addArticle__input" value="{{$article->title}}"/>
                </div>
                @error('title') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror
                <div class="field">
                    <label for="category_id">Категория</label>
                    <select name="category_id" id="category_id" class="addArticle__input">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                                    @if($article->category_id === $category->id)
                                        selected
                                @endif
                            >{{$category->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror
                <div class="field">
                    <label for="text">Текст статьи</label>
                    <textarea name="text" id="text" class="addArticle__text">{{$article->text}}</textarea>
                </div>
                @error('text') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror
                <div class="field mb60">
                    <label for="file">Изображение</label>
                    <div class="file-attach">
                        Выберите изображение
                        <input type="file" name="image" class="addArtilce__input">
                    </div>
                </div>
                @error('image') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror

                <button class="button">Сохранить</button>

            </form>
        </div>
    </div>
@endsection
