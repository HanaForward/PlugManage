@extends('layouts._header', ['Games' => app(\App\Models\games::class)->categories()])


@section('title', '主页')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">个人中心</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>


            <div class="container">
                <div class="col-md-8 offset-md-2">

                    <div class="card">
                        <div class="card-header">
                            <h4>
                                <i class="glyphicon glyphicon-edit"></i> 编辑个人资料
                            </h4>
                        </div>

                        <div class="card-body">

                            <form action="{{ route('users.update', $user->id) }}" method="POST" accept-charset="UTF-8">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                @include('shared._errors')


                                <div class="form-group">
                                    <label for="name-field">用户名</label>
                                    <input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $user->name) }}" />
                                </div>
                                <div class="form-group">
                                    <label for="email-field">邮 箱</label>
                                    <input class="form-control" type="text" name="email" id="email-field" value="{{ old('email', $user->email) }}" />
                                </div>

                                <div class="well well-sm">
                                    <button type="submit" class="btn btn-primary">保存</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->


@stop