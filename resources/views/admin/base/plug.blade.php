@extends('admin.layouts.header', ['Games' => app(\App\Models\Games::class)->categories()])


@section('title', '管理中心')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">插件管理</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-pane fade in active" id="plugs-Manage">
                        <!-- Table -->

                        <div class="row">
                            <div class="col-sm-3">
                                <button data-toggle="modal" data-target="#Publish" class="btn btn-success">发布插件</button>
                            </div>
                            <div class="col-sm-3 col-sm-push-6">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <hr/>

                        <!-- Table -->
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            @include('shared._errors')
                            <thead>
                            <tr>
                                <th style="width: 80px">uuidShort</th>
                                <th>插件名</th>
                                <th>说明</th>
                                <th>价格</th>
                                <th>管理</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($Plugs as $plug)
                                <tr>
                                    <td id="plug_uuidShort">{{$plug->uuidShort}}</td>
                                    <td id="plug_name">{{$plug->name}}</td>
                                    <td id="plug_description">{{$plug->description}}</td>
                                    <td id="plug_price">{{$plug->price}}</td>
                                    <td>
                                        <button id="change" class="btn btn-success btn-xs" data-toggle="modal"
                                                data-target="#PlugUpdate">修改
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div style="margin: 0px auto;display: table;">
                            {{ $Plugs->links() }}
                        </div>
                        <hr/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="PlugUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="text-center" id="myModalLabel">插件修改</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{route('admin.plug.updata',$game_id)}}" method="POST">
                        {{ csrf_field() }}

                        <input name="uuidShort" type="hidden" class="form-control" id="uuidShort" >

                        <div class="form-group">
                            <label for="firstname" class="col-xs-2 control-label">插件名</label>
                            <div class="col-xs-8">
                                <input name="name" type="text" class="form-control" id="name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="firstname" class="col-xs-2 control-label">价格</label>
                            <div class="col-xs-8">
                                <input name="price" type="text" class="form-control" id="price">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="firstname" class="col-xs-2 control-label">描述</label>
                            <div class="col-xs-8">
                                <input name="description" type="text" class="form-control" id="description">
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <span id="returnMessage" class="glyphicon"> </span>
                            <button type="button" class="btn btn-default right" data-dismiss="modal">取消修改</button>
                            <button id="submitBtn" type="button" class="btn btn-primary" onclick="submit()">保存修改</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <div class="modal fade" id="Publish" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="text-center" id="myModalLabel">插件发布</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{route('admin.plug.publish',$game_id)}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="firstname" class="col-xs-2 control-label">插件名</label>
                            <div class="col-xs-8">
                                <input name="name" type="text" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="firstname" class="col-xs-2 control-label">价格</label>
                            <div class="col-xs-8">
                                <input name="price" type="text" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="firstname" class="col-xs-2 control-label">描述</label>
                            <div class="col-xs-8">
                                <input name="description" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="col-xs-2 control-label">提交</label>
                            <div class="col-xs-8">
                                <input name="plug_data" type="file" required>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <span id="returnMessage" class="glyphicon"> </span>
                            <button type="button" class="btn btn-default right" data-dismiss="modal">关闭提交</button>
                            <button id="submitBtn" type="button" class="btn btn-primary" onclick="submit()">发布插件</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script language="JavaScript">
        $("tr").each(function () {
            $("#change", this).click(function () {
                var table = $(this).parents("tr");

                var uuid = table.children('td#plug_uuidShort').html();
                var name = table.children('td#plug_name').html();
                var price = table.children('td#plug_price').html();
                var des = table.children('td#plug_description').html();


                $("#uuidShort").val(uuid);
                $("#name").val(name);
                $("#price").val(price);
                $("#description").val(des);
            });
        });

    </script>


@stop

@extends('layouts._footer')