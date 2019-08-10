@extends('layouts._header', ['Games' => app(\App\Models\Games::class)->categories()])


@section('title', '主页')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div id="row">
                <div class="col-lg-12">
                    <h1 class="page-header">令牌</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            令牌列表
                            <button class="btn btn-default btn-sm pull-right" data-toggle="modal" data-target="#myModal">添加</button>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>别名</th>
                                        <th>Key</th>

                                        <th>绑定</th>
                                        <th>最后使用</th>
                                        <th>创建日期</th>
                                        <th>管理</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($Tokens as $Token)
                                    <tr>

                                        <td>{{$Token->alias}}</td>


                                        <td>{{$Token->token}}</td>


                                        @if($Token->bind == '')
                                                <td>0.0.0.0</td>
                                            @else
                                                <td>{{$Token->bind}}</td>
                                        @endif
                                        <td>{{$Token->updated_at}}</td>
                                        <td>{{$Token->created_at}}</td>

                                        <td>
                                            <a class="btn btn-success btn-sm">修改</a>
                                            <a class="btn btn-danger btn-sm"  href="{{route('token/delete') . '?Token=' . $Token->token}}">删除</a>

                                        </td>

                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
            </div>
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

    <script language="JavaScript">


    </script>

@stop

@extends('layouts._footer')