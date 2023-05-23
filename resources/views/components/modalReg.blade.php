<div class="registration-modal attach">
    <div class="registration-modal__wrapper">
        <div class="modal-logo">MYLE</div>
        <div class="modal-close"><i class="fa fa-times" aria-hidden="true"></i></div>
        <div class="rightSide-image">
            <img src="{{asset('public/assets/staticImages/modalImg.png')}}" alt="">
            <div class="modal-signup__ref">Уже есть аккаунт? - <u class="loginFromReg">Авторизуйтесь!</u> </div>
        </div>

        <div class="login-leftSide">

            <form action="{{route('signup')}}" class="login-form " method="post" enctype="multipart/form-data" id="registr">
                @csrf
                <h3 class="h3-login">Регистрация</h3>
                <div class="login-field">
                    <label for="name">ФИО*</label>
                    <input type="text" id="name" name="name"  value="{{old('name')}}">
                </div>
                @error('name') <span class="danger" id="alert">{{$message}}</span> @enderror
                <div class="login-field">
                    <label for="email_reg">Электронаня почта*</label>
                    <input type="email" id="email" name="email_reg"  value="{{old('email_reg')}}">
                </div>
                @error('email_reg') <span class="danger" id="alert">{{$message}}</span>@enderror
                <div class="login-field">
                    <label for="phone_number">Номер телефона*</label>
                    <input type="text" id="phone_number" name="phone_number"  value="{{old('phone_number')}}">
                </div>
                @error('phone_number') <span class="danger" id="alert">{{$message}}</span>@enderror
                <div class="login-field">
                    <label for="city">Город*</label>
                    <input type="text" id="city" name="city"  value="{{old('city')}}">
                </div>
                @error('city') <span class="danger" id="alert">{{$message}}</span>@enderror
                <div class="login-field file-attach file-attach__reg">
                    Выберите изображение
                    <input type="file" name="image" class="addArtilce__input">
                </div>
                @error('image') <span class="danger" id="alert">{{$message}}</span>@enderror


                <div class="login-field">
                    <label for="password_reg">Пароль*</label>
                    <input type="password" id="password" name="password_reg" value="{{old('password_reg')}}">
                </div>
                @error('password_reg') <span class="danger" id="alert">{{$message}}</span>@enderror
                <div class="login-field">
                    <label for="re_password">Повторите пароль*</label>
                    <input type="password" id="re_password" name="re_password" value="{{old('re_password')}}">
                </div>
                @error('re_password') <span class="danger" id="alert">{{$message}}</span>@enderror

                <div class="required-input">*Обязатлеьное поле</div>
                <div class="required-input signup-resize modal-signup__ref2">Уже есть аккаунт? - <u>Авторизуйтесь!</u></div>

                <button class="login-button">Регистрация</button>
            </form>
        </div>

    </div>
</div>
