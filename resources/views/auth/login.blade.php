@extends('layouts.index')
@section('content')
    <div class="container">
        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <div class="m-login m-login--singin  m-login--5" id="m_login" style="background-image: url(theme/dist/html/default/assets/app/media/img//bg/bg-3.jpg);">
                <div class="m-login__wrapper-1 m-portlet-full-height">
                    <div class="m-login__wrapper-1-1">
                        <div class="m-login__contanier">
                            <div class="m-login__content">
                                <div class="m-login__logo">
                                    <a href="#">
                                        <img src="{{ asset('theme/dist/html/default/assets/app/media/img/logos/logo-2.png') }}">
                                    </a>
                                </div>
                                <div class="m-login__title">
                                    <h3>
                                        JOIN OUR GREAT METRO COMMUNITY GET FREE ACCOUNT
                                    </h3>
                                </div>
                                <div class="m-login__desc">
                                    Amazing Stuff is Lorem Here.Grownng Team
                                </div>
                                <div class="m-login__form-action">
                                    <button type="button" id="m_login_signup" class="btn btn-outline-focus m-btn--pill">
                                        Get An Account
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="m-login__border">
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="m-login__wrapper-2 m-portlet-full-height">
                    <div class="m-login__contanier">
                        <div class="m-login__signin">
                            <div class="m-login__head">
                                <h3 class="m-login__title">
                                    Login To Your Account
                                </h3>
                            </div>
                            <form class="form-horizontal m-login__form m-form" method="POST" action="">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('usrUserName') ? ' has-error' : '' }} m-form__group">
                                    <input id="usrUserName" type="text" class="form-control m-input" name="usrUserName" placeholder="Login" value="25834147-3" maxlength="10" autofocus required>
                                </div>

                                <div class="form-group{{ $errors->has('usrPassword') ? ' has-error' : '' }} m-form__group">
                                    <input id="usrPassword" class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="usrPassword" required>
                                </div>


                                 <div class="row m-login__form-sub">
                                    <div class="col m--align-left">
                                        <label class="m-checkbox m-checkbox--focus">
                                            <input type="checkbox" id="remember" name="remember" value="0" {{ old('remember') ? 'checked' : '' }}> Recordarme
                                            <span></span>
                                        </label>
                                    </div>
                                    <div class="col m--align-right">
<!--                                          <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Forgot Your Password?
                                        </a> -->
                                        <a href="javascript:;" id="m_login_forget_password" class="m-link">
                                            Olvido su contraseña ?
                                        </a>
                                    </div>
                                </div>


                                <div class="m-login__form-action">
                                    <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                                        Entrar
                                    </button> 
                                </div>
                            </form>
                        </div>
                        <div class="m-login__signup">
                            <div class="m-login__head">
                                <h3 class="m-login__title">
                                    Sign Up
                                </h3>
                                <div class="m-login__desc">
                                    Enter your details to create your account:
                                </div>
                            </div>
                            <form class="m-login__form m-form" action="">
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="text" placeholder="Fullname" name="fullname">
                                </div>
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
                                </div>
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="password" placeholder="Password" name="password">
                                </div>
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Confirm Password" name="rpassword">
                                </div>
                                <div class="m-login__form-sub">
                                    <label class="m-checkbox m-checkbox--focus">
                                        <input type="checkbox" name="agree">
                                        I Agree the
                                        <a href="#" class="m-link m-link--focus">
                                            terms and conditions
                                        </a>
                                        .
                                        <span></span>
                                    </label>
                                    <span class="m-form__help"></span>
                                </div>
                                <div class="m-login__form-action">
                                    <button id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                                        Sign Up
                                    </button>
                                    <button id="m_login_signup_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="m-login__forget-password">
                            <div class="m-login__head">
                                <h3 class="m-login__title">
                                    Forgotten Password ?
                                </h3>
                                <div class="m-login__desc">
                                    Enter your email to reset your password:
                                </div>
                            </div>
                            <!-- <form class="m-login__form m-form" action="POST"> -->
                            <form class="form-horizontal m-login__form m-form" method="POST" action="">
                                {{ csrf_field() }}
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" value="antojmz@gmail.com" autocomplete="off">
                                </div>
                                <div class="m-login__form-action">
                                    <button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                                        Request
                                    </button>
                                    <button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom ">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Page -->
    </div>
    <!--begin::Page Snippets -->
    <script type="text/javascript" src="{{ URL::asset('theme/dist/html/default/assets/snippets/pages/user/login.js') }}"></script>
    <!--end::Page Snippets -->
@endsection