@extends('account.account')

@section('config')
    <div class="card">
        <div class="card-header">
            <h4>视频上传</h4>
        </div>
        <div class="card-block background-image"
             style="background-image: url('//ws2.sinaimg.cn/large/a15b4afegw1f4i318r5hgj22bc0wnn6n.jpg')">
            <h5 style="text-align: center;padding-bottom: .6em;color: white">点击上传你的精彩视频</h5>
            <div style="text-align: center">
                <button type="button" class="btn btn-info">上传视频</button>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>最近录制的视频
                <span class="live-sub-title">
                    <a href="{{ url(route('record_all')) }}"><i class="fa fa-terminal"></i> 查看全部</a>
                </span>
            </h4>
        </div>
        <div class="card-block">
            <div class="row">
                @foreach($play_info_list as $play_info)
                    <div class="col-sm-4">
                        <a href="{{ url(route('record_manage').'?vid='.$play_info['id']) }}">
                            <div class="card shadow-card no-margin-bottom">
                                <div class="video-card"
                                     style="background-image: url('{{ $play_info['cover'] ? $play_info['cover'] : '//ws2.sinaimg.cn/orj480/a15b4afegw1f174um1elhj20g4093abh.jpg' }}');"></div>
                                <div class="video-card-title">
                                    <p class="card-text" style="color:white">{{ $play_info['name'] }}</p>
                                </div>
                            </div>
                        </a>
                        <p class="description-text">录制于 {{ $play_info['created_at'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>最近上传的视频
                <span class="live-sub-title">
                    <a href="#"><i class="fa fa-terminal"></i> 查看全部</a>
                </span>
            </h4>
        </div>
        <div class="card-block">

        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $(".video-card").css("height", $(".video-card").width() * 0.63 + "px");
            $(window).resize(function () {
                $(".video-card").css("height", $(".video-card").width() * 0.63 + "px");
            });
        });
    </script>
@endsection