@extends('layouts.auth')

@section('title', '登录')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading text-center">
                        <h3 class="panel-title">注册</h3>
                    </div>
                    <div class="panel-body">
                        @include('shared._errors')
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(session()->has($msg))
                                <div class="flash-message">
                                    <p class="alert alert-{{ $msg }}">
                                        {{ session()->get($msg) }}
                                    </p>
                                </div>
                            @endif
                        @endforeach

                        <form method="POST" action="{{ route('user.store') }}">
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="用户名" name="username" type="text"  value="{{ old('username') }}" >
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="密码" name="password" type="password">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="确认密码" name="password_confirmation" type="password">
                                </div>

                                <div class="form-group">
                                    <input class="form-control" placeholder="昵称" name="name" type="text"  value="{{ old('name') }}" >
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="邮箱" name="email" type="text"  value="{{ old('email') }}" >
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-primary btn-block">登录</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
