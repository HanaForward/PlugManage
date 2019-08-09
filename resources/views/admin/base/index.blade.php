@extends('admin.layouts.header', ['Games' => app(\App\Models\games::class)->categories()])


@section('title', '管理中心')

@section('content')




@stop

@extends('layouts._footer')