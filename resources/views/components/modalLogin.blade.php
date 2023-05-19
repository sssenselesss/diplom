<div class="login-modal ">
    <div class="login-modal__wrapper">
        <div class="modal-logo">MYLE</div>
        <div class="modal-close"><i class="fa fa-times" aria-hidden="true"></i></div>
        <div class="rightSide-image">
            <img src="{{asset('public/assets/staticImages/modalImg.png')}}" alt="">
            <div class="modal-signup__ref">Нет аккаунта? - <u class="regFromLogin">Зарегистрируйтесь!</u> </div>
        </div>

        <div class="login-leftSide">

            <form action="{{route('signin')}}" class="login-form" method="post">
                @csrf
                <h3 class="h3-login">Авторизация</h3>
                <div class="login-field">
                    <label for="email">Электронная почта*</label>
                    <input type="text" id="email" name="email">
                </div>
                @error('email') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror
                <div class="login-field">
                    <label for="password">Пароль*</label>
                    <input type="text" id="password" name="password">
                </div>
                @error('password') <span class="danger danger-log" id="alert">{{$message}}</span>@enderror
                <div class="required-input">*Обязатлеьное поле</div>
                <div class="required-input signup-resize modal-signup__ref2">Нет аккаунта? - <u>Зарегистрируйтесь!</u></div>

                <a href="{{route('resetPassword')}}" class="required-input">Восстановить пароль</a>
                <button class="login-button">Войти</button>
            </form>
        </div>

    </div>
</div>
