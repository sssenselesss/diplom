@extends('layout.index')
@section('page_title','Найти задание')

@section('content')
    <div class="catalog-search">
        <form method="get" action="{{route('catalogSearch')}}" class="catalog-search__wrapper">
            <div class="search-title">
                <div class="search-title__text"><a href="{{route('catalog')}}">Все задания</a></div>
            </div>

            <div class="search-field">
                <input type="text" placeholder="Поиск по ключевому слову" name="search" id="search">
                <button class="find">Найти</button>
            </div>
            <div class="found">Найдено {{count($total)}} заданий</div>
        </form>
    </div>

    <div class="catalog-items">
        <div class="catalog-items__wrapper">
            <div class="category-modal__button">
                <div class="burger"><i class="fa fa-navicon" aria-hidden="true"></i></div>
                Категории
            </div>
            @if(count($tasks)=== 0 )
                <span class="null">По вашему запросу ничего не найдено</span>

            @else
                @foreach($tasks as $task)
                    <div class="order">
                        <a href="{{route('singleTask',$task->id)}}" class="title-price">
                            <span class="order-title">{{$task->title}}</span>
                            <span class="order-price">{{$task->price}} ₽</span>
                        </a>

                        <div class="order-address">{{$task->place}}</div>

                        <div class="order-line"></div>

                        <div class="order-down">
                            <a href="{{route('profile',$task->author_id)}} "
                               class="order-author">
                                <div class="order-author__image">
                                    @if($task->author()->image === null)
                                        <img src="{{asset('public/assets/avatars/default.png')}}" alt="Фото профиля">
                                    @else
                                        <img src="{{$task->author()->getImageUrlAttribute()}}"
                                             alt="Фото профиля">
                                    @endif

                                </div>
                                <div class="order-author__name_price">

                                    <span class="order-author__name">{{$task->author()->name}}</span>
                                    <span
                                        class="order-author__rate">Отзвывы: {{$task->author()->feedback($task->author()->id)}} </span>
                                </div>
                            </a>


                        </div>
                    </div>
                @endforeach

            @endif


        </div>

        <div class="catalog-categories">
            <form action="{{route('catalogFilter')}}">
                @csrf
                @foreach($mainCat as $main)

                    <div class="main-category__arrow">
                        <div class="arrow-angle"><i class="fa fa-angle-down" aria-hidden="true"></i></div>
                        <h5>{{$main->name}}</h5>




                        <div class="sub-category__arrow ">

                            @foreach($subCat as $sub)
                                @if($main->id === $sub->main_category)

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="categories[]"
                                               value="{{$sub->id}}"
                                               id="{{$sub->name}}"
                                               @foreach($categories1 as $category)

                                                   @if($category == $sub->id)
                                                       checked
                                            @endif
                                            @endforeach
                                        >
                                        <label class="form-check-label" for="{{$sub->name}}">
                                            {{$sub->name}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>


                @endforeach


                <button class="show">Показать</button>
            </form>

        </div>


        <div class="categories-modal">
            <div class="categories-modal__wrapper">
                <form action="" class="catalog-categories__form">
                    @csrf
                    @foreach($mainCat as $main)
                        <h5>{{$main->name}}</h5>
                        @foreach($subCat as $sub)

                            @if($main->id === $sub->main_category)

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="categories[]"
                                           value="{{$sub->id}}"
                                           id="{{$sub->name}}"
                                           @foreach($categories1 as $category)

                                               @if($category == $sub->id)
                                                   checked
                                        @endif
                                        @endforeach
                                    >
                                    <label class="form-check-label" for="{{$sub->name}}">
                                        {{$sub->name}}
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    @endforeach


                    <button class="show">Показать</button>


                </form>
            </div>
        </div>


    </div>
    <div class="padding-container catalog-pagination">

        {{$tasks->links()}}

    </div>

@endsection('content')
