@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="sub-header">
            <h3 class="room-title">
                <img src="//cdn.v2ex.com/gravatar/{{ md5($email) }}?s=60"
                     class="live-title-avatar">
                {{ $title }}
                <span class="live-sub-title">
                    主播: <span style="color:#ff5371;">{{ $name }}</span>
                </span>
                <span class="live-sub-title">
                    当前在线 <span style="color:#ff5371;" id="onlineNum">loading...</span> 人
                </span>
            </h3>
        </div>
        <div class="container-build row">
            <div class="col-xs-12 col-sm-12 col-md-8">
                <div class="card shadow-card" id="left-card">
                    <div class="live-card" id="player"></div>
                    <div class="card-block">
                        <span>播放模式选择：</span>
                        <a class="btn btn-primary btn-sm">
                            FLASH（延迟低）
                        </a>
                    </div>
                </div>
                <div class="card shadow-card" id="player-controller">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="card shadow-card danmaku-card">
                    <div class="card-text danmaku-card-title">
                        <p class="card-text"><i class="fa fa-comments"></i> Danmaku</p>
                    </div>
                    <div class="card-block danmaku-card-content" id="printWall"
                         style="background-color: #f8f8f8;"></div>
                    <div class="card-text danmaku-input">
                        <div class="input-group">
                            <input type="text" id="danmaku" class="form-control" placeholder="输入弹幕内容...">
                            <span class="input-group-btn">
                                <button class="btn btn-info" type="button" id="send-btn"><i
                                            class="fa fa-paper-plane-o"></i> Biu!</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card shadow-card">
            <div class="card-block">
                <h4 class="card-title"><i class="fa fa-tags"></i> 简介</h4>
                <p class="card-text">{!! $description !!}</p>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ url('/js/vendor/realtime.browser.min.js') }}"></script>
    <script src="{{ url('/js/vendor/blive.js') }}"></script>
    <script src="{{ url('/js/danmaku.js') }}"></script>
    <script>
        danmakuInit('{{ $appId }}', '{{ $roomId }}');
        var player = new CloudLivePlayer();
        player.init({activityId: "{{ $activityId }}"}, 'player');
        $(document).ready(function () {
            var playerHeight = $(".live-card").width() * 0.5625;
            $(".live-card").css("height", playerHeight + "px");
            $(".danmaku-card").css("height", $("#left-card").height() + "px");
            $(".danmaku-card-content").css("height", $("#left-card").height() - $(".danmaku-card-title").height() - $(".danmaku-input").height() + "px");
            $(window).resize(function () {
                $(".live-card").css("height", $(".live-card").width() * 0.5625 + "px");
                $(".danmaku-card").css("height", $("#left-card").height() + "px");
                $(".danmaku-card-content").css("height", $("#left-card").height() - $(".danmaku-card-title").height() - $(".danmaku-input").height() + "px");
            });
        });
    </script>
@endsection