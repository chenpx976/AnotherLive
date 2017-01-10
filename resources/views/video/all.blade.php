@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        @if(!$count)
            <div class="container-fluid">
                <div class="sub-header">
                    <div style="width:100%;text-align: center">
                        <img style="width:100%;max-width: 400px;"
                             src="//ws2.sinaimg.cn/large/a15b4afegw1f4ds5mrvwmj20fu0cin55.jpg">
                    </div>
                </div>
            </div>
            <div class="container-fluid" style="text-align: center">
                <h5>现在没人在直播，戳下右上角开个直播吧</h5>
            </div>
        @else
            <div class="sub-header">
                <h3>{{ $title or 'AnotherLive' }}
                <span class="live-sub-title">
                    当前共有 <span style="color:#ff5371;">{{ $count }}</span> 个直播
                </span>
                </h3>
            </div>
            <div class="container-build row">
                @foreach($liveInfo as $value)
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
                        <p class="description-text">{{ $value['description'] }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $(".live-card").css("height", $(".live-card").width() * 0.63 + "px");
            $(window).resize(function () {
                $(".live-card").css("height", $(".live-card").width() * 0.63 + "px");
            });
        });
    </script>
@endsection