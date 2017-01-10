<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>{{ isset($title) ? ($title . " - ") : null }}AnotherLive</title>
    <link rel="shortcut icon" href="{{ url('/favicon.ico') }}">
    <link rel="stylesheet" href="{{ url('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="//cdn.bootcss.com/tether/1.3.2/css/tether.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel='stylesheet' href="//fonts.iwch.me/css?family=Open+Sans:600">
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
    @yield('css')
</head>
<script src="//cdn.bootcss.com/jquery/2.2.0/jquery.js"></script>
@yield('top-js')
<body>
<div class="container-fluid top-bar">
    <nav class="navbar navbar-inverse navbar-fixed-top live-nav-top">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fa fa-home"></i> AnotherLive
        </a>
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url(route('all')) }}"><i class="fa fa-genderless"></i> 全部直播</a>
            </li>
        </ul>
        <ul class="nav navbar-nav pull-right">
            @if (Auth::guard('admin')->guest())
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/register') }}"><i class="fa fa-user-plus"></i> 注册</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/login') }}"><i class="fa fa-sign-in"></i> 登录</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/admin') }}"><i class="fa fa-user"></i> {{ Auth::guard('admin')->user()->name }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/admin/logout') }}"><i class="fa fa-sign-out"></i> 登出</a>
                </li>
            @endif
        </ul>
    </nav>
    @yield('banner')
</div>
<div class="main-content">
    @yield('content')
    <div class="container-fluid">
        <footer class="content-footer">
            © 2016 <a href="https://niconiconi.org" target="_blank">Volio</a> All right reserved
        </footer>
    </div>
</div>
<script src="//cdn.bootcss.com/tether/1.3.2/js/tether.min.js"></script>
<script src="{{ url('/js/vendor/bootstrap.min.js') }}"></script>
@yield('js')
</body>
</html>