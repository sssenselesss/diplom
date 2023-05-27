@extends('layout.index')
@section('page_title','Мои заказы - исполнитель')

@section('content')
    <div class="myOrders">
        <div class="wrapper">
            <div class="selectRole">
                <a href="{{route('ordersExecutor')}}" class="roleButton  ">Я исполнитель</a>
                <a href="{{route('ordersCustomer')}}" class="roleButton ">Я заказчик</a>
                <a href="{{route('ordersAll')}}" class="roleButton ">Созданные заказы</a>
                <a href="{{route('respondOrders')}}" class="roleButton active">Откликнулись</a>


            </div>

            <div class="orders-container">
                @if(count($orders) !== 0)
                    @foreach($orders as $order)
                        <div class="order">
                            <div class="title-price">
                                <a href="{{route('singleTask',$order->task_id)}}" class="order-title">{{$order->task()->title}}</a>
                                <span class="order-price">{{$order->task()->money()}} </span>
                            </div>

                            <div class="order-address">{{$order->task()->place}}</div>

                            <div class="order-line"></div>

                            <div class="order-down">
                                <div class="order-author">
                                    <div class="order-author__image">
                                        @if($order->customer()->image === null)
                                            <img src="{{asset('public/assets/avatars/default.png')}}" alt="123">
@else
                                            <img src="{{$order->task()->author()->getImageUrlAttribute()}}" alt="123">

                                        @endif
                                    </div>
                                    <div class="order-author__name_price">
                                        <a href="{{route('profile',$order->customer_id)}}" class="order-author__name">{{$order->task()->author()->name}}</a>
                                        <span class="order-author__rate">Отзвывы:{{$order->customer()->feedback($order->customer_id)}} </span>
                                    </div>
                                </div>

                                @if($order->status === 'at_work')
                                    <div class="order-status ">В работе</div>
                                @endif

                                @if($order->status === 'waiting')
                                    <div class="order-status "> В ожидании</div>

                                @endif
                                @if($order->status === 'finished')
                                    <div class="order-status "> Завершена</div>

                                @endif


                            </div>
                        </div>

                    @endforeach
                @else
                    <div class="empty"> Пока никто не откликнулся</div>
                @endif


            </div>

        </div>
    </div>

@endsection
