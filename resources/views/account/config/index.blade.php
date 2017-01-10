@extends('account.account')

@section('config')
    <div class="card">
        <div class="card-header">
            <h4>个人信息</h4>
        </div>
        <div class="card-block">
            <div class="container-fluid top-bar row user-center-left">
                <div class="col-xs-12 col-md-3">
                    <img src="//cdn.v2ex.com/gravatar/{{ md5(Auth::user()->email) }}?s=130" width="100%"
                         class="image-border">
                </div>
                <div class="col-xs-12 col-md-9">
                    <h4 class="user-info-right">{{ Auth::user()->name }}
                        <span class="user-info-setting">
                            <a href="{{ url(route('account_setting')) }}"><i class="fa fa-pencil"></i> 修改昵称</a>
                        </span>
                    </h4>
                    <h6 class="user-info-right">{{ Auth::user()->email }}
                        <span class="user-info-setting">
                            <a href="{{ url(route('account_setting')) }}"><i class="fa fa-pencil"></i> 修改邮箱</a>
                        </span>
                    </h6>
                    <h6 class="user-info-right">
                        <span>直播状态：</span>
                        @if($live_status)
                            <span style="color:#0074d9">正在直播</span>
                            <span class="user-info-setting">
                                <a href="{{ url(route('live_manage')) }}"><i class="fa fa-play-circle"></i> 结束直播</a>
                            </span>
                        @else
                            <span style="color:#0074d9">未直播</span>
                            <span class="user-info-setting">
                                <a href="{{ url(route('live_manage')) }}"><i class="fa fa-play-circle"></i> 开始直播</a>
                            </span>
                        @endif
                    </h6>
                </div>
            </div>
            <hr/>
            <div class="container-fluid top-bar">
                <h6>直播间地址：
                    <span class="user-info-setting">
                        <a href="{{ url('/'.Auth::user()->id) }}" target="_blank">
                            <i class="fa fa-link"></i> {{ url('/'.Auth::user()->id) }}
                        </a>
                    </span>
                </h6>
            </div>
        </div>
    </div>
    @if($blocked)
        <div class="card">
            <div class="card-header">
                <h4><img src="//ws2.sinaimg.cn/large/a15b4afegw1f4g1pb8wclg202201ljrc.jpg" style="padding-right: 1em">提示</h4>
            </div>
            <div class="card-block">
                <p>您的账户暂时不能创建直播</p>
            </div>
        </div>
    @endif
@endsection