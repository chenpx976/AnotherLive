@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="sub-header">
            <h3>{{ $title or 'AnotherLive' }}</h3>
        </div>
        <div class="container-build row">
            <div class="col-xs-12 col-md-4 user-center-left">
                <div class="list-group">
                    <a href="{{ url(route('account')) }}" class="list-group-item
                    @if(URL::current() == url(route('account'))) active @endif">
                        <i class="fa fa-user"></i> 个人信息
                    </a>
                    <a href="{{ url(route('account_setting')) }}" class="list-group-item
                    @if(URL::current() == url(route('account_setting'))) active @endif">
                        <i class="fa fa-cog"></i> 资料设置
                    </a>
                    <a href="{{ url(route('account_manage')) }}" class="list-group-item
                    @if(URL::current() == url(route('account_manage'))) active @endif">
                        <i class="fa fa-rocket"></i> 直播间设置
                    </a>
                    <a href="{{ url(route('live_manage')) }}" class="list-group-item
                    @if(URL::current() == url(route('live_manage'))) active @endif">
                        <i class="fa fa-circle-o"></i> 直播管理
                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-md-8">
                @yield('config')
            </div>
        </div>
    </div>
@endsection