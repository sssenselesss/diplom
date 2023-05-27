@extends('layout.index')
@section('page_title','Создать задание')

@section('content')
    <div class="addOrder addArticle attach mt90">
        <h2 class="h2-title mb60">Создать задание</h2>
        <div class="wrapper">
            <form action="{{route('createTask')}}" class="addArtcile-form" method="post" enctype="multipart/form-data">
                @csrf
                <div class="field">
                    <label for="title">Название</label>
                    <input type="text" name="title" id="title" class="addArticle__input" value="{{old('title')}}" />
                </div>
                @error('title') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror
                <div class="field">
                    <label for="category_id">Категория </label>
                    <select name="category_id" id="category_id" class="select-form">
                        @foreach($mainCat as $main)
                            <optgroup label="{{$main->name}}">
                                @foreach($subCat as $sub)
                                    @if($sub->main_category === $main->id)
                                        <option value="{{$sub->id}}">{{$sub->name}}</option>
                                    @endif

                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
                @error('category_id') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror
                <div class="field">
                    <label for="description">Подробное описание заявки ( <span class="currentLengt">0</span>/300) </label>
                    <textarea name="description" id="description" class="addArticle__text" maxlength="300">{{old('description')}}</textarea>
                </div>
                @error('text') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror
                <div class="field">
                    <label for="option">Дополнительно ( <span class="currentLengt otherLength">0</span>/300)</label>
                    <textarea name="option" id="option" class="addArticle__text Othertext">{{old('option')}}</textarea>
                </div>
                @error('option') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror
                <div class="field">
                    <label for="place">Место</label>
                    <input  type="text" name="place" id="place" class="addArticle__input" value="{{old('place')}}"/>
                </div>
                @error('place') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror
                <div class="field">
                    <label for="price">Бюджет</label>
                    <input type="number" name="price" id="price" class="addArticle__input"  value="{{old('price')}}"/>
                </div>
                @error('price') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror

                <div class="field">
                    <label for="date_start">Дата начала</label>
                    <input type="date" name="date_start" id="date_start" class="addArticle__input" value="{{old('date_start')}}"/>
                </div>
                @error('date_start') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror

                <div class="field">
                    <label for="date_end">Дата окончания</label>
                    <input type="date" name="date_end" id="date_end" class="addArticle__input" value="{{old('date_end')}}" />
                </div>
                @error('date_end') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror

                <div class="field mb60">
                    <label for="file">Изображение</label>
                    <div class="file-attach">
                        Выберите изображение
                        <input type="file" class="addArtilce__input" name="image">
                    </div>
                </div>
                @error('image') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror


                <button class="button">Добавить</button>

            </form>
        </div>
    </div>
@endsection
