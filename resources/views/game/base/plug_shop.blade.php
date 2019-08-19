@extends('game.layouts.game_header', ['Games' => app(\App\Models\Games::class)->categories()])


@section('title', '管理')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">插件商店</h1>
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
                                    <td class="hidden" id="uuid"><input type="hidden" name="uuid" value="{{$plug->uuidShort}}"></td>
                                    <td id="name">{{$plug->name}}</td>
                                    <td>{{$plug->type}}</td>
                                    <td>{{$plug->description}}</td>
                                    <td>{{$plug->owner->name}}</td>
                                    <td id="price">@if($plug->price == 0)免费
                                        @else{{$plug->price}} RMB
                                        @endif
                                    </td>
                                    <td>
                                        <button id="buy" class="btn btn-success btn-xs" data-toggle="modal"
                                                data-target="#Modal">购买
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div style="margin: 0px auto;display: table;">
                            {{ $plug_shop->links() }}
                        </div>
                        <hr/>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="text-center" id="myModalLabel">购买插件</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="{{route('buy')}}" method="POST" role="form">
                            {{ csrf_field() }}
                            <input id="plug_uuid" type="hidden" name="uuid">
                            <div class="form-group">
                                <label for="firstname" class="col-xs-2 control-label">插件名</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" id="plug_name" value="插件名" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="firstname" class="col-xs-2 control-label">价格</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" id="plug_price" value="价格" disabled>
                                </div>
                            </div>


                            <div class="form-group">
                                <p class="text-center">付款方式</p>
                                <div class="row text-center">
                                    <div class="col-xs-3"></div>

                                    <div class="col-xs-2">
                                        <input type="radio" id="wechat" name="pay_channel" value="3"/>
                                        <label for="wechat">
                                            <img style="width: 64px;height: 64px"
                                                 src="https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=199783060,2774173244&fm=58&s=188FA15AB1206D1108400056000040F6&bpow=121&bpoh=75">
                                        </label>
                                        微信支付
                                    </div>

                                    <div class="col-xs-2">
                                        <input type="radio" id="alipay" name="pay_channel" value="2"/>
                                        <label for="alipay">
                                            <img style="width: 64px;height: 64px"
                                                 src="http://aopsdkdownload.cn-hangzhou.alipay-pub.aliyun-inc.com/doc/ShaXiang.png">
                                        </label>
                                        支付宝支付
                                    </div>

                                    <div class="col-xs-2">
                                        <input type="radio" id="balance" name="pay_channel" value="1"/>
                                        <label for="balance">
                                            <img style="width: 64px;height: 64px"
                                                 src="/img/money.png">
                                        </label>
                                        余额支付
                                    </div>

                                    <div class="col-xs-3"></div>
                                </div>
                            </div>


                            <hr>

                            <div class="text-center">
                                <span id="returnMessage" class="glyphicon"> </span>
                                <button type="button" class="btn btn-default right" data-dismiss="modal">关闭订单</button>
                                <button id="submitBtn" type="button" class="btn btn-primary" onclick="submit()">提交订单
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $("tr").each(function () {
            $("#buy", this).click(function () {
                var table = $(this).parents("tr");
                var uuid = table.children('td#uuid').children("input").val();
                var name = table.children('td#name').html();
                var price = table.children('td#price').html();
                $("#plug_uuid").val(uuid);
                $("#plug_name").val(name);
                $("#plug_price").val(price);
            });
        });
    </script>





@stop

@extends('layouts._footer')