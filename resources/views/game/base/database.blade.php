@extends('game.layouts.game_header', ['Game' => app(\App\Http\Controllers\Game\Game_304930::class)->categories()])

@section('title', '管理')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">数据库管理</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            数据库列表
                            <div class="pull-right">
                                <button class="btn btn-default btn-sm">添加</button>
                            </div>

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>名字</th>
                                        <th>标识</th>
                                        <th>主机</th>
                                        <th>端口</th>
                                        <th>密码</th>
                                        <th>数据库</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>数据库1</td>
                                        <td>72f1eb0f</td>
                                        <td>127.0.0.1</td>
                                        <td>3306</td>
                                        <td>7b82</td>
                                        <td>Unturned</td>
                                        <td><a class="btn btn-xs btn-success" style="margin-right: 20px">验证</a><a class="btn btn-xs btn-danger">删除</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
    </div>
@stop

@extends('layouts._footer')
