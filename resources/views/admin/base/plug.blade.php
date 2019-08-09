@extends('admin.layouts.header', ['Games' => app(\App\Models\games::class)->categories()])


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
                            <thead>
                            <tr>
                                <th style="width: 80px">uuidShort</th>
                                <th>插件名</th>
                                <th>类型</th>
                                <th>说明</th>
                                <th>价格</th>
                                <th>管理</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($Plugs as $plug)
                                <tr>
                                    <td id="uuid">{{$plug->uuidShort}}</td>
                                    <td id="name">{{$plug->name}}</td>
                                    <td>{{$plug->type}}</td>
                                    <td>{{$plug->description}}</td>
                                    <td id="price">{{$plug->price}} RMB</td>
                                    <td>
                                        <button id="buy" class="btn btn-success btn-xs" data-toggle="modal"
                                                data-target="#Modal">修改
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

    <div class="modal fade" id="Publish" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="text-center" id="myModalLabel">发布插件</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{route('admin.plug.publish',$game_id)}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="firstname" class="col-xs-2 control-label">插件名</label>
                            <div class="col-xs-8">
                                <input name="name" type="text" class="form-control" id="plug_name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="firstname" class="col-xs-2 control-label">价格</label>
                            <div class="col-xs-8">
                                <input name="price" type="text" class="form-control" id="plug_price">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="firstname" class="col-xs-2 control-label">描述</label>
                            <div class="col-xs-8">
                                <input name="description" type="text" class="form-control" id="plug_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="col-xs-2 control-label">提交</label>
                            <div class="col-xs-8">
                                <input name="plug_data" type="file" id="plug_data" required>
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



@stop

@extends('layouts._footer')