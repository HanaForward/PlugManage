<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="/css/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/css/startmin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="/js/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="/js/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="/js/startmin.js"></script>


</head>
<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{route('index')}}">控制台</a>
        </div>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>



        <div class="navbar-header">
            <a class="pull-right btn btn-default" href="{{route('admin.index')}}" >开发者中心</a>
        </div>



        <ul class="nav navbar-right navbar-top-links">
            <li class="dropdown">

                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>{{ Auth::user()->username }} <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> 账户</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> 设置</a>
                    </li>
                    <li class="divider"></li>

                    <li>
                        <form action="{{ route('logout') }}" id="formId" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <a href="#" onclick="document:formId.submit()"><i class="fa fa-sign-out fa-fw"></i> 登出</a>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

                    <li>
                        <a href="{{ route('index') }}" ><i class="fa fa-industry fa-fw"></i> 状态</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-user fa-fw"></i> 账户</a>
                        <ul class="nav nav-second-level">
                            <li >
                                <a href="{{ route('users.show',Auth::id()) }}" >个人中心</a>
                            </li>
                            <li>
                                <a href="{{ route('users.edit',Auth::id()) }}" >编辑资料</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-gamepad fa-fw"></i> 游戏<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @foreach ($Games as $Game)
                                <li>
                                    <a href="/game/{{$Game->GameId}}">{{$Game->GameName}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-lock fa-fw"></i> API<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ route('token') }}">Token</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')


    @if (app()->isLocal())
        @include('sudosu::user-selector')
    @endif

</div>

</body>
</html>