@extends('layout.index')
@section('page_title','Все пользователи')

@section('content')
    <div class="admin mt90 allCategories">
        <h2 class="h2-title mb60">Админ панель</h2>
        <div class="admin-wrapper">
            <div class="admin-select-bar">
                <div class="select-item "><a href="{{route('adminAllUsers')}}">Все пользователи</a></div>
                <div class="select-item"><a href="{{route('adminAllTasks')}}">Задания</a></div>
                <div class="select-item active"><a href="{{route('adminAllCategories')}}">Все категории</a></div>

                <div class="select-item "><a href="{{route('adminAllComplaints')}}">Жалобы</a> </div>

            </div>

            <div class="admin-search">
                <div href="" class="button add-category__modal-open" >Добавить категорию</div>
            </div>

            <div class="addCategory-modal">
                <div class="modal-wrapper">
                    <div class="modal-close close-black"><i class="fa fa-times" aria-hidden="true"></i></div>

                    <h3 >Добавить категорию</h3>
                    <form action="{{route('createCategory')}}" method="post">
                        @csrf
                        <div class="field">
                            <label for="mainCat">Группа категорий</label>
                            <select name="main_category" id="mainCat" class="select-form">
                                <option value="">--- Выберите категорию ---</option>
                                @foreach($mainCat as $mc)
                                    <option value="{{$mc->id}}">{{$mc->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('main_category') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror


                        <div class="field">
                            <label for="name">Название категории</label>
                            <input type="text" id="name" name="name"class="addArticle__input">
                        </div>
                        @error('name') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror



                        <button class="button">Добавить</button>
                    </form>
                </div>

            </div>

            <div class="admin-categories__container">
                @if(count($mainCat)===0 && count($subCat) === 0 )
                    Пока нет категорий
                @else
                    @foreach($mainCat as $mc)
                        <div class="main-category">
                            <h4>{{$mc->name}}</h4>
                            @foreach($subCat as $sc)
                                @if($mc->id === $sc->main_category)
                                    <div class="sub-categories">
                                        <span class="category">{{$sc->name}}</span>
                                        <a  href="{{route('deleteCategory',$sc->id)}}" class="delete-category"> <i class="fa fa-times" aria-hidden="true"></i> </a>
                                    </div>
                                    @endif
                            @endforeach


                        </div>

                    @endforeach
                @endif
            </div>

        </div>
    </div>

@endsection
