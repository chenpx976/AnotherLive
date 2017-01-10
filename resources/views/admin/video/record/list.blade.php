@extends('admin.video')

@section('manage')
    <div class="card">
        <div class="card-header">
            <h4>录制视频管理</h4>
        </div>
        <div class="card-block">
            <div class="row">
                @foreach($record_videos as $video)
                    <div class="col-sm-3">
                        <a href="{{ url(route('admin_record_manage').'?vid='.$video['id']) }}">
                            <div class="card shadow-card no-margin-bottom">
                                <div class="video-card"
                                     style="background-image: url('{{ $video['cover'] ? $video['cover'] : '//ws2.sinaimg.cn/orj480/a15b4afegw1f174um1elhj20g4093abh.jpg' }}');"></div>
                                <div class="video-card-title">
                                    <p class="card-text" style="color:white">{{ $video['name'] }}</p>
                                </div>
                            </div>
                        </a>
                        <p class="description-text">录制于 {{ $video['created_at'] }}</p>
                    </div>
                @endforeach
            </div>
            <nav>
                {!! $record_videos->links() !!}
            </nav>
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