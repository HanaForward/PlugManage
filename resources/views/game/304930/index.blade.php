@extends('game.layouts.game_header', ['Game' => app(\App\Http\Controllers\Game\Game_304930::class)->categories()])


@section('title', '管理')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">服务器列表</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            在线服务器列表
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>UUID</th>
                                        <th>Name</th>
                                        <th>模板</th>
                                        <th>在线玩家</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="odd gradeX">
                                        <td>ddaa04c7-71ec-4942-8368-8bfd660ec1cc</td>
                                        <td>测试用服务器</td>
                                        <td>f8f01ccc</td>
                                        <td class="center">24</td>
                                        <td class="center">
                                            控制台
                                        </td>
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
