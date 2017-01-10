@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="sub-header">
            <h3>{{ $title or 'AnotherLive' }}</h3>
        </div>
        <div class="container-build row">
            <div class="col-xs-12 col-md-4 user-center-left">
                <div class="list-group">
                    <a href="{{ url(route('admin_index')) }}" class="list-group-item
                    @if(URL::current() == url(route('admin_index'))) active @endif">
                        <i class="fa fa-bars"></i> 平台信息
                    </a>
                    <a href="{{ url(route('admin_users_blocked')) }}" class="list-group-item
                    @if(URL::current() == url(route('admin_users_blocked'))) active @endif">
                        <i class="fa fa-users"></i> 待审核用户
                    </a>
                    <a href="{{ url(route('admin_users_normal')) }}" class="list-group-item
                    @if(URL::current() == url(route('admin_users_normal'))) active @endif">
                        <i class="fa fa-users"></i> 已注册用户
                    </a>
                    <a href="{{ url(route('admin_act_info')) }}" class="list-group-item
                    @if(URL::current() == url(route('admin_act_info'))) active @endif">
                        <i class="fa fa-cog"></i> 直播活动管理
                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-md-8">
                @yield('manage')
            </div>
        </div>
    </div>
@endsection