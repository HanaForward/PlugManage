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
                                <button class="btn btn-default btn-sm">添加</button>
                            </div>

                        </div>
                        <!-- /.panel-heading -->
                        1
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>别名</th>
                                        <th>标识</th>
                                        <th>数据库</th>
                                        <th>插件数量</th>
                                        <th>管理</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="odd gradeX">
                                        <td>PVE</td>
                                        <td>72f1eb0f</td>
                                        <td>数据库1</td>
                                        <td>5</td>
                                        <td><a>管理</a></td>
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


@stop

@extends('layouts._footer')