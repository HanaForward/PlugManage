@extends('layouts._header', ['Games' => app(\App\Models\Games::class)->categories()])


@section('title', '管理')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">插件列表</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-pane fade in active" id="plugs-Manage">
                        <!-- Table -->
                        <div class="row">
                            <div class="col-sm-3 col-sm-push-9">
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

                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>插件名</th>
                                <th>类型</th>
                                <th>说明</th>
                                <th>作者</th>
                                <th>状态</th>
                                <th>管理</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($plug_list as $plug)
                            <tr>
                                <td>{{$plug->plug->name}}</td>
                                <td>{{$plug->plug->type}}</td>
                                <td>{{$plug->plug->description}}</td>
                                <td>{{$plug->owner->name}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-success active">开启</button>
                                        <button type="button" class="btn btn-xs btn-danger">停用</button>
                                    </div>
                                </td>
                                <td>
                                    <button id="config" class="btn btn-default btn-xs"><a href="#">配置</a></button>
                                </td>
                            </tr>
                            </tbody>
                            @endforeach
                        </table>
                        <hr/>

                        <div style="margin: 0px auto;display: table;">
                            {{ $plug_list->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>












@stop

@extends('layouts._footer')