@extends('layouts._header', ['Games' => app(\App\Models\Games::class)->categories()])


@section('title', '管理中心')

@section('content')




@stop

@extends('layouts._footer')