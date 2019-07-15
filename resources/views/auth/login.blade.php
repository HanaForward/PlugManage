@extends('layouts.auth')

@section('title', '登录')




@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading text-center">
                        <h3 class="panel-title">登录</h3>
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

                        <form method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="用户名/E-mall" name="username" type="text"  value="{{ old('username') }}" >
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="密码" name="password" type="password">
                                </div>
                                <div class="checkbox">
                                    <label class="pull-right">
                                        <input name="remember" type="checkbox" value="Remember Me">自动登录
                                    </label>
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

    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../js/startmin.js"></script>


@endsection
