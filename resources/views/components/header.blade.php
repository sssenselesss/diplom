<header class="header">
    <div class="header-wrapper">
        <div class="header-logo">
            <a href="{{route('main')}}">MYLE</a>
        </div>
        <ul class="header-nav">
            <li><a href="{{route('main')}}">Главная</a></li>
            <li><a href="{{route('createTask')}}">Создать задание</a></li>
            <li><a href="{{route('catalog')}}">Найти задания</a></li>
            <li><a href="{{route('frequent')}}">Частые вопросы</a></li>
            @auth()
                <li><a href="{{route('ordersCustomer')}}">Мои задания</a></li>
            @endauth
        </ul>
        <div class="header-buttons">
            @auth()
                @if(\Illuminate\Support\Facades\Auth::user()->role ==='admin')
                    <a href="{{route('adminAllUsers')}}" class="button ">Админ панель</a>
                @endif
                <a href="{{route('profile',\Illuminate\Support\Facades\Auth::user()->id)}}" class="button ">Профиль</a>
                <a href="{{route('logout')}}" class="button ">Выйти</a>
            @endauth
            @guest()
                <a class="button modal-open__login">Войти</a>
            @endguest
        </div>
        <div class="burger-block">
            <div class="burger"><i class="fa fa-navicon" aria-hidden="true"></i></div>
            <div class="burger-menu">
                <ul class="burger-nav">
                    <li><a href="{{route('main')}}">Главная</a></li>
                    <li><a href="{{route('createTask')}}">Создать задание</a></li>
                    <li><a href="{{route('catalog')}}">Найти задания</a></li>
                    <li><a href="{{route('frequent')}}">Частые вопросы</a></li>
                </ul>
                <div class="burger-buttons">
                    @guest()
                        <a class="openModal__burger">Войти</a>
                        <a class="openModal__burger_reg">Регистрация</a>
                    @endguest

                    @auth()
                        @if(\Illuminate\Support\Facades\Auth::user()->role ==='admin')
                            <a href="{{route('adminAllUsers')}}">Админ панель</a>
                        @endif

                        <a href="{{route('ordersCustomer')}}">Заказы</a><br>
                        <a href="{{route('profile',\Illuminate\Support\Facades\Auth::user()->id)}}">Профиль</a><br>
                        <a href="{{route('logout')}}" class="">Выйти</a>
                    @endauth

                </div>
            </div>
        </div>

    </div>
</header>

