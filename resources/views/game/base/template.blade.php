@extends('layouts._header', ['Games' => app(\App\Models\Games::class)->categories()])
<link rel="stylesheet" href="http://demo.htmleaf.com/1508/201508261557/css/build.css"
      xmlns:v-bind="http://www.w3.org/1999/xhtml">

<style>
    .checkbox {
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }

    select {
        width: 120px;
    }
</style>


<script src="https://cdn.staticfile.org/vue/2.6.10/vue.min.js"></script>
<script src="https://cdn.staticfile.org/axios/0.18.0/axios.min.js"></script>


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

                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(session()->has($msg))
                                <div class="flash-message">
                                    <p class="alert alert-{{ $msg }}">
                                        {{ session()->get($msg) }}
                                    </p>
                                </div>
                            @endif
                        @endforeach


                        <div class="panel-heading">
                            模板列表
                            <div class="pull-right">
                                <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#CreatTemplate">
                                    添加
                                </button>
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
                                        <th>插件</th>
                                        <th>管理</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($templates as $template)
                                        <tr>
                                            <td id="{{$template->template_uuid}}">{{$template->alias}}</td>
                                            <td>0</td>
                                            <td>0 <a class="btn btn-xs btn-success pull-right">修改</a></td>
                                            <td>{{$template->count_plug}}
                                                <button id="plug_set" class="btn btn-default btn-xs pull-right"
                                                        data-toggle="modal" data-target="#PlugSet"
                                                        data-uuid="{{$template->template_uuid}}">修改
                                                </button>
                                            </td>
                                            <td><a href="{{route('template.delete',$gameid).'?template_uuid='.$template->template_uuid}}" class="btn btn-xs btn-danger pull-right">删除</a></td>
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

        <div class="modal fade" id="CreatTemplate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">添加Template</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="{{route('template.create',$gameid)}}" method="POST" role="form">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="col-xs-2 control-label">别名</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" name="alias" id="alias" placeholder="请输入别名">
                                </div>
                            </div>

                            <hr>

                            <div class="text-center">
                                <span id="returnMessage" class="glyphicon"> </span>
                                <button type="button" class="btn btn-default right" data-dismiss="modal">关闭</button>
                                <button id="submitBtn" type="button" class="btn btn-primary" onclick="submit()">提交
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="PlugSet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title text-center" id="myModalLabel">插件修改</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form id="table">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>开启</th>
                                        <th>插件名</th>
                                        <th>插件版本</th>
                                        <th>插件配置</th>
                                        <th>使用数据库</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(item,index) in newsList">
                                        <th>
                                            <div class="checkbox">
                                                <input v-bind:id="item.uuid" v-model="item.switch"
                                                       v-bind:name=item.uuid class="styled" type="checkbox">
                                                <label v-bind:for="item.uuid" class="styled" hidden="hidden"></label>
                                            </div>
                                        </th>
                                        <th>
                                            <label v-bind:for="item.uuid">@{{item.name}}</label>
                                        </th>
                                        <th>
                                            <select name="version">
                                                <option>release</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="config">
                                                <option>Null</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="database">
                                                <option>Null</option>
                                            </select>
                                        </th>
                                    </tr>
                                    </tbody>
                                </table>

                                <hr>

                                <div class="text-center">
                                    <span id="returnMessage" class="glyphicon"> </span>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">取消修改</button>
                                    <button type="button" @click="b()" data-dismiss="modal" class="btn btn-primary">提交更改</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal -->
        </div>

    </div>

    <script type="text/javascript">

        var app = new Vue({
            el: '#table',
            data: {
                newsList: null,
                template_uuid : null,

            },
            methods: {
                //新增
                a(uuid) {
                    this.template_uuid = uuid;
                    axios
                        .get('/get_show_pluglist', {
                            params: {
                                template_uuid: uuid,
                            }
                        })
                        .then(
                            response => {
                                this.newsList = response.data;
                                this.$set();
                            }
                        )
                        .catch(function (error) { // 请求失败处理
                            console.log(error);
                        });

                },
                b() {
                    axios.get("/get_update_pluglist", {
                        params: {
                            data:
                                JSON.stringify(this.newsList),
                                template_uuid : this.template_uuid
                        }

                    })
                        .then(
                            response => {
                            }
                        )
                        .catch(function (error) { // 请求失败处理
                            console.log(error);
                        });

                },
                clear(){
                    this.newsList = null;

                }
            }
        });


        $(function () {
            $('#PlugSet').on('show.bs.modal', function (event) {
                app.clear();
                var modal = $(this);  //get modal itself
                var uuid = $(event.relatedTarget).data('uuid');
                app.a(uuid);
            });
        });


    </script>


@stop

@extends('layouts._footer')