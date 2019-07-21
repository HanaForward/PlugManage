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


                        <!-- Table -->
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>插件名</th>
                                <th>类型</th>
                                <th>说明</th>
                                <th>作者</th>
                                <th>价格</th>
                                <th>管理</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($plug_shop as $plug)
                            <tr>
                                <td>{{$plug->name}}</td>

                                <td>{{$plug->type}}</td>

                                <td>{{$plug->description}}</td>

                                <td>{{$plug->owner}}</td>
                                <td>
                                    <a>{{$plug->price}}</a>
                                </td>
                                <td>
                                    <button id="buy" class="btn btn-success btn-xs"><a href="#">购买</a></button>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div  style="margin: 0px auto;display: table;">
                            {{ $plug_shop->links() }}
                        </div>



                        <hr/>


                    </div>
                </div>
            </div>
        </div>
@stop

@extends('layouts._footer')