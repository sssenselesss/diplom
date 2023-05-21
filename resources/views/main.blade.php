@extends('layout.index')
@section('page_title','Главная')


@section('content')
    <div class="banner">

        <img src="{{asset('public/assets/staticImages/banner.png')}}" alt="">
        <div class="banner-content">
            <h1> Освободим вас от забот</h1>
            <p>Поможем найти надёжного исполнителя для любых задач</p>
        </div>
    </div>
as
    <div class="infograph">
        <div class="wrapper">
            <div class="graph-item">
                <div class="circle">
                    <img src="{{asset('public/assets/staticImages/icons/services.png')}}" alt="">
                </div>
                <h3>Широкий выбор услуг</h3>
                <span class="graph-content">Доступно более 30 подкатегорий для выбора</span>
            </div>
            <div class="graph-item">
                <div class="circle">
                    <img src="{{asset('public/assets/staticImages/icons/time.png')}}" alt="">

                </div>
                <h3>Экономия времени</h3>
                <span class="graph-content">На нашем сайте вы можете быстро найти нужного исполнителя для решения именно вашей задачи</span>
            </div>
            <div class="graph-item">
                <div class="circle">
                    <img src="{{asset('public/assets/staticImages/icons/price.png')}}" alt="">

                </div>
                <h3>Выгодные цены на услуги</h3>
                <span class="graph-content">У наших  исполнителей  нет дополнительных затрат, которые все сервисные компании включают в стоимость своих услуг.</span>
            </div>
            <div class="graph-item">
                <div class="circle">
                    <img src="{{asset('public/assets/staticImages/icons/users.png')}}" alt="">

                </div>
                <h3>Надежные исполнители</h3>
                <span class="graph-content">Все исполнители  проходят у нас процедуру верификации, мы проверяем отзывы о них, контролируем вместе с вами качество их работы</span>
            </div>
        </div>
    </div>

    <div class="feedback">
        <h2 class=" mb60 h2-title">Отзывы об исполнителях</h2>
        <div class="wrapper">

            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @if(count($feedbacks)!== 0 )
                        @foreach($feedbacks as $fb)
                            <div class="swiper-slide">
                                <div class="feed-title">{{$fb->task()->title}}</div>
                                <div class="feed-price">Оплата: {{$fb->task()->money()}} </div>
                                <div class="feed-content">{{$fb->text}}</div>
                                <div class="feed-date">{{ substr($fb->created_at,0,11)}}</div>

                                <div class="feed-user">
                                    <div class="feed-image">
                                        @if($fb->executor()->image === null)
                                            <img src="{{asset('public/assets/avatars/default.png')}}" alt="">

                                        @else
                                            <img src="{{$fb->executor()->getImageUrlAttribute()}}" alt="123">

                                        @endif
                                    </div>
                                    <div class="feed-user__info">
                                        <span class="name-user">{{$fb->executor()->name}}</span>

                                        <div class="rate">Рейтинг <i class="fa fa-star" aria-hidden="true"></i> {{   number_format($fb->average($fb->executor_id),1)     }}</div>
                                        <div class="cancel-orders">Выполнил {{$fb->finished($fb->executor_id)}} заданий</div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                        @else
                        <div class="null">Пока нет отзывов</div>
                        @endif





                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <div class="howItWorks">
        <h2 class="mt90 mb60 h2-title">Как это работает?</h2>
        <div class="wrapper">
            <div class="how-image">
                <img src="{{asset('public/assets/staticImages/howItWorks.png')}}" alt="">

            </div>

            <div class="how-content">
                <div class="for_customer">
                    <span class="content-title">Для заказчика</span>
                    <div class="how-items">
                        <div class="how-item">
                            <div class="how-circle">
                                <div class="inner-circle">1</div>
                            </div>
                            <div class="innerText">Зарегистрируйтесь</div>
                        </div>

                        <div class="how-item">
                            <div class="how-circle">
                                <div class="inner-circle">2</div>
                            </div>
                            <div class="innerText">Создайте заявку</div>
                        </div>

                        <div class="how-item">
                            <div class="how-circle">
                                <div class="inner-circle">3</div>
                            </div>
                            <div class="innerText">Выберите исполнителя</div>
                        </div>

                        <div class="how-item">
                            <div class="how-circle">
                                <div class="inner-circle">4</div>
                            </div>
                            <div class="innerText">Оставьте отзыв</div>
                        </div>



                    </div>
                </div>

                <div class="for_customer">
                    <span class="content-title">Для исполнителя</span>
                    <div class="how-items">
                        <div class="how-item">
                            <div class="how-circle">
                                <div class="inner-circle">1</div>
                            </div>
                            <div class="innerText">Зарегистрируйтесь</div>
                        </div>

                        <div class="how-item">
                            <div class="how-circle">
                                <div class="inner-circle">2</div>
                            </div>
                            <div class="innerText">Заполните необходимые данные</div>
                        </div>

                        <div class="how-item">
                            <div class="how-circle">
                                <div class="inner-circle">3</div>
                            </div>
                            <div class="innerText">Найдите подходящий заказ</div>
                        </div>

                        <div class="how-item">
                            <div class="how-circle">
                                <div class="inner-circle">4</div>
                            </div>
                            <div class="innerText">Оставье заявку</div>
                        </div>

                        <div class="how-item">
                            <div class="how-circle">
                                <div class="inner-circle">5</div>
                            </div>
                            <div class="innerText">Выполните задание и получие отзыв</div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="usefull-article mt90">
        <h2 class="mt90 mb60 h2-title">Полезные статьи</h2>
        <div class="wrapper mb60 mt60">

            @if(count($articles)!== 0 )
                @foreach($articles as $article)
                    <div class="article">
                        <div class="article-image">
                            <img src="{{$article->getImageUrlAttributeArticle()}}" alt="">
                        </div>
                        <div class="article-date">{{$article->created_at}}</div>
                        <div class="article-title">{{$article->title}}</div>

                    </div>
                @endforeach
            @else
                <div class="null">      Пока нет статей</div>

                @endif





        </div>

        <div class="other-button">
                <a href="{{route('articles')}}">  Посмотреть все статьи</a></div>


    </div>
@endsection
