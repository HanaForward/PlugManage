@extends('game.layouts.game_header', ['Game' => app(\App\Http\Controllers\Game\Game_304930::class)->categories()])


@section('title', '管理')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">模板管理</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            模板列表
                            <div class="pull-right">
                                <button class="btn btn-default btn-xs">添加</button>
                            </div>

                        </div>
                        <!-- /.panel-heading -->

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>别名</th>
                                        <th>服务器</th>
                                        <th>数据库</th>
                                        <th>插件数量</th>
                                        <th>管理</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($templates as $template)
                                    <tr>
                                        <td>{{$template->alias}}</td>
                                        <td>1</td>
                                        <td>1 <a class="btn btn-xs btn-success pull-right">修改</a></td>
                                        <td>5 <a class="btn btn-xs btn-success pull-right">修改</a></td>
                                        <td><a class="btn btn-xs btn-danger pull-right">删除</a></td>
                                    </tr>
                                    @endforeach
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

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">添加Token</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="{{route('token/create')}}" method="POST" role="form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="firstname" class="col-xs-2 control-label">别名</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" name="alias" id="alias" placeholder="请输入别名">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstname" class="col-xs-2 control-label">服务器</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" name="server" id="alias" placeholder="请添加服务器">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstname" class="col-xs-2 control-label">插件</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" name="plug" id="alias" placeholder="请添加插件">
                                </div>
                            </div>

                            <hr >

                            <div class="text-right">
                                <span id="returnMessage" class="glyphicon"> </span>
                                <button type="button" class="btn btn-default right" data-dismiss="modal">关闭</button>
                                <button id="submitBtn" type="button" class="btn btn-primary" onclick="submit()">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


@stop

@extends('layouts._footer')