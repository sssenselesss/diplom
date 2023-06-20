@extends('layout.index')
@section('page_title','Мои заказы - исполнитель')

@section('content')
    <div class="myOrders">
        <div class="wrapper">
            <div class="selectRole">
                <a href="{{route('ordersExecutor')}}" class="roleButton ">Я исполнитель</a>
                <a href="{{route('ordersCustomer')}}" class="roleButton ">Я заказчик</a>
                <a href="{{route('ordersAll')}}" class="roleButtonactive ">Созданные заказы</a>
                <a href="{{route('respondOrders')}}" class="roleButton ">Откликнулись</a>

            </div>

            <div class="orders-container">
                @if(count($executors) !== 0)
                    @foreach($executors as $exe)

                        <div class="order" data-task-id="{{$exe->id}}"
                             data-exe-id="{{$exe->author_id}}"
                             data-order-id="{{$exe->id}}"
                             data-cust-id="{{$exe->author_id}}">
                            <div class="title-price">
                                <a href="{{route('singleTask',$exe->id)}}"
                                   class="order-title">{{$exe->title}}</a>
                                <span class="order-price">{{$exe->money()}} </span>
                            </div>

                            <div class="order-address">{{$exe->place}}</div>

                            <div class="order-line"></div>

                            <div class="order-down">
                                <div class="order-author">
                                    <div class="order-author__image">
                                        @if($exe->image === null)
                                            <img src="{{asset('public/assets/avatars/default.png')}}" alt="">

                                        @else
                                            <img src="{{$exe->task()->getImage()}}" alt="">

                                        @endif
                                    </div>
                                    <div class="order-author__name_price">
                                        <a href="{{route('profile',$exe->author_id)}}"
                                           class="order-author__name">{{$exe->author()->name}}</a>
                                        <span class="order-author__rate">Отзвывы: {{$exe->author()->feedback($exe->author_id)}}  </span>
                                    </div>
                                </div>

                                @if($exe->status === 'at_work')
                                    <a href="{{route('finishOrder',$exe)}}" class="order-status ">Завершить</a>
                                @endif

                                @if($exe->status === 'new')
                                    <div class="order-status "> Новая</div>

                                @endif
                                @if($exe->status === 'finished')
                                    <div class="finished">
                                        <div class="order-status "> Завершена</div>




                                    </div>


                                @endif


                            </div>
                        </div>

                    @endforeach
                @else
                    <div class="empty"> У вас нет созданных заданий</div>
                @endif


            </div>

        </div>
    </div>

    <div class="modal-order">
        <div class="modal-window">
            <div class="modal-close close-black">
                <i class="fa fa-times" aria-hidden="true"></i>
            </div>
            <span class="modal-order__title">Напишите отзыв об исполнителе</span>
            <span class="modal-order__subtitle">Оставляя отзыв, вы помогаете другим заказчикам выбирать исполнителя, который подойдет им лучше всего</span>

            <form action="{{route('createFeedback')}}" method="post" class="modal-order__form">
                @csrf
                <div class="form__item">
                    <div class="simple-rating">
                        <div class="simple-rating__items">
                            <input id="simple-rating__5" type="radio" value="5" class="simple-rating__item"
                                   name="rate">
                            <label for="simple-rating__5" class="simple-rating__label"></label>

                            <input id="simple-rating__4" type="radio" value="4" class="simple-rating__item"
                                   name="rate">
                            <label for="simple-rating__4" class="simple-rating__label"></label>

                            <input id="simple-rating__3" type="radio" value="3" class="simple-rating__item"
                                   name="rate">
                            <label for="simple-rating__3" class="simple-rating__label"></label>

                            <input id="simple-rating__2" type="radio" value="2" class="simple-rating__item"
                                   name="rate">
                            <label for="simple-rating__2" class="simple-rating__label"></label>

                            <input id="simple-rating__1" type="radio" value="1" class="simple-rating__item"
                                   name="rate" >
                            <label for="simple-rating__1" class="simple-rating__label"></label>
                        </div>
                    </div>


                </div>
                @error('rate') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror

                <input type="hidden" name="task_id" class="task_id" value="{{old('task_id')}}">
                <input type="hidden" name="executor_id" class="executor_id" value="{{old('executor_id')}}">
                <input type="hidden" name="customer_id" class="customer_id" value="{{old('customer_id')}}">
                <input type="hidden" name="order_id" class="order_id" value="{{old('order_id')}}">
                <div class="field">
                    <label for="rate">Комментарий* ( <span class="currentLengt">0</span>/300)   </label>
                    <textarea name="text" id="" cols="30" rows="10" class="modal-order__textarea" maxlength="300" ></textarea>
                </div>
                @error('text') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror

                <button class="button">Отправить</button>
            </form>

        </div>
    </div>

@endsection
