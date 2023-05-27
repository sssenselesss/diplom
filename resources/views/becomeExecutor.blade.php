@extends('layout.index')
@section('page_title','Редактировать статью')

@section('content')
    <div class="addArticle mt90">
        <h2 class="h2-title mb60">Стать исполнителем</h2>
        <div class="wrapper">
            <form action="{{route('becomeExecutor')}}" class="addArtcile-form" method="post"
                  enctype="multipart/form-data">
                @csrf

                <div class="field">
                    <label for="experience">Опыт работы</label>
                    <textarea name="experience" id="experience" class="addArticle__text" placeholder="Не менее 10 символов"></textarea>
                </div>
                @error('experience') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror

                <div class="field">
                    <label for="about">Расскажите о себе</label>
                    <textarea name="about" id="about" class="addArticle__text" placeholder="Не менее 30 символов"></textarea>
                </div>
                @error('about') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror

                <div class="field">
                    <label for="text">Выберите категории</label>
                </div>
                <div class="checkboxes">

                        @foreach($mainCat as $main)
                        <div class="main-check">
                            <h5 class="main-title">{{$main->name}}</h5>
                            <div class="subcheck">
                                @foreach($subCat as $sub)
                                    @if($sub->main_category === $main->id)
                                        <div class="form-check form-executor">
                                            <input class="form-check-input" name="categories[]" type="checkbox" value="{{$sub->id}}" id="{{$sub->name}}" >
                                            <label class="form-check-label" for="{{$sub->name}}">
                                                {{$sub->name}}
                                            </label>
                                        </div>
                                    @endif

                                @endforeach
                            </div>
                        </div>
                        @endforeach


                </div>
                @error('categories[]') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror



                <button class="button mt60">Сохранить</button>

            </form>
        </div>
    </div>
@endsection
