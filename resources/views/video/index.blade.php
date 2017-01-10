@extends('layouts.layout')

@section('banner')
    <div class="container-fluid top-bar">
        <div class="banner">
            <div class="banner-room">
                <div class="player-shadow">
                    <div id="player" class="banner-player"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="sub-header">
            <h3>正在直播
                <span class="live-sub-title">
                    当前共有 <span style="color:#ff5371;">{{ $living_count }}</span> 个直播
                </span>
                <span class="live-sub-title">
                    <a href="{{ url(route('all')) }}"><i class="fa fa-terminal"></i> 查看更多</a>
                </span>
            </h3>
        </div>
        <div class="container-build row">
            @if(!$living_count)
                <div class="col-xs-6 col-sm-6 col-md-3">
                    <img src="//ws2.sinaimg.cn/large/a15b4afegw1f4ds5mrvwmj20fu0cin55.jpg" style="width: 100%">
                </div>
            @endif
            @foreach($live_info as $value)
                <div class="col-xs-6 col-sm-6 col-md-3">
                    <a href="{{ url('/'.$value['uid']) }}">
                        <div class="card shadow-card no-margin-bottom">
                            <div class="live-card"
                                 style="background-image: url({{ $value['cover'] ? $value['cover'] : '//ws2.sinaimg.cn/orj480/a15b4afegw1f3n1bg7jmvj23m32jou14.jpg' }});"></div>
                            <div class="live-card-title">
                                <div class="live-card-avatar">
                                    <img src="//cdn.v2ex.com/gravatar/{{ md5($value['email']) }}?s=50">
                                </div>
                                <p class="card-text" style="color:white">{{ $value['title'] }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ url('/js/vendor/blive.js') }}"></script>
    <script>
        var player = new CloudLivePlayer();
        player.init({activityId: "{{ $activityId }}"}, 'player');
        $(document).ready(function () {
            $(".banner-player").css("height", $(".banner-player").width() * 0.5625 + "px");
            $(".live-card").css("height", $(".live-card").width() * 0.63 + "px");
            $(".directory-card").css("height", $(".directory-card").width() * 1.4 + "px");
            $(window).resize(function () {
                $(".banner-player").css("height", $(".banner-player").width() * 0.5625 + "px");
                $(".live-card").css("height", $(".live-card").width() * 0.63 + "px");
                $(".directory-card").css("height", $(".directory-card").width() * 1.4 + "px");
            });
        });
    </script>
@endsection