@extends('layout.index')
@section('page_title','Добавить статью')

@section('content')
    <div class="addArticle2 mt90 attach">
        <h2 class="h2-title mb60">Добавить статью</h2>
        <div class="wrapper">
            <form action="{{route('articleCreate.post')}}" class="addArtcile-form" method="post" enctype="multipart/form-data">
                @csrf
                <div class="field">
                    <label for="title">Заголовок</label>
                    <input name="title" id="title" class="addArticle__input" />
                </div>
                @error('title') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror
                <div class="field">
                    <label for="category_id">Категория</label>
                    <select name="category_id" id="category_id" class="addArticle__input">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name  }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror
                <div class="field">
                    <label for="text">Текст статьи</label>
                    <textarea name="text" id="text" class="addArticle__text"></textarea>
                </div>
                @error('text') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror
                <div class="field ">
                    <label for="file">Изображение</label>
                    <div class="file-attach">
                        Выберите изображение
                        <input type="file" name="image" class="addArtilce__input">
                    </div>

                </div>
                @error('image') <span class="danger danger-log " id="alert">{{$message}}</span>@enderror


                <button class="button mt60">Добавить</button>

            </form>
        </div>
    </div>
@endsection
