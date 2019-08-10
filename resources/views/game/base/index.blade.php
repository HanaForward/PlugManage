@extends('layouts._header', ['Games' => app(\App\Models\Games::class)->categories()])

<script src="https://cdn.staticfile.org/vue/2.6.10/vue.min.js"></script>
<script src="https://cdn.staticfile.org/axios/0.18.0/axios.min.js"></script>

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
                                    @foreach ($Servers as $Server)
                                        <tr>
                                            <td>{{$Server->server_uuid}}</td>
                                            <td>{{$Server->name}}</td>
                                            <td>@if(is_null($Server->template))
                                                    Null
                                                @else{{$Server->template->alias}}
                                                @endif<a class="btn btn-success btn-xs pull-right" data-toggle="modal"
                                                         data-uuid="{{$Server->server_uuid}}"
                                                         data-target="#ChangeTemplate">切换</a></td>
                                            <td class="center">Null</td>
                                            <td class="center"><a href="{{route('server.delete',$game_id).'?server_uuid='.$Server->server_uuid}}" class="btn btn-danger btn-xs pull-right">删除</a></td>
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
    </div>

    <div class="modal fade" id="ChangeTemplate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">选择模板</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('server.update',$game_id)}}"  >
                        {{ csrf_field() }}
                        <input id="server_uuid" type="hidden" name="server_uuid" value="">
                        <div class="form-group">
                            <label class="col-xs-2 control-label">模板</label>
                            <div class="col-xs-8" id="app">
                                <select  name="template_uuid">
                                    <option v-for="item in newsList" v-bind:value="item.template_uuid">
                                        @{{item.alias}}(@{{item.template_uuid}})
                                    </option>
                                </select>
                            </div>
                        </div>

                        <hr>

                        <div class="text-center">
                            <span id="returnMessage" class="glyphicon"> </span>
                            <button type="button" class="btn btn-default right" data-dismiss="modal">关闭</button>
                            <button id="submitBtn" type="button" class="btn btn-primary" onclick="submit()">提交</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        var app = new Vue({
            el: '#app',
            data: {
                newsList: null,
                template_uuid: null,

            },
            methods: {
                //新增
                a(uuid) {
                    this.template_uuid = uuid;
                    axios
                        .get('/get_templates', {
                            params: {
                                game_id: 304930,
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
                clear() {
                    this.newsList = null;
                }
            }
        });


        $(function () {
            $('#ChangeTemplate').on('show.bs.modal', function (event) {
                app.clear();
                var modal = $(this);  //get modal itself
                var uuid = $(event.relatedTarget).data('uuid');

                $('#server_uuid').val(uuid);

                app.a(uuid);
            });
        });


    </script>



@stop

@extends('layouts._footer')
