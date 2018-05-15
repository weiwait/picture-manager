<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="ueditor/lang/zh-cn/zh-cn.js"></script>
    <title>@yield('title', '图片管理器')</title>
    <style type="text/css">
        body {
            background: #f5f5f5;
        }

        * {
            margin: 0;
            padding: 0;
        }

        .cf:after {
            content: '';
            display: block;
            clear: both;
        }

        #contain {
            width: 1260px;
            margin: 0 auto;
        }

        #editor-container {
            width: 1260px;
            margin: 0 auto;
        }

        #editor {
            width: 1260px;
        }

        .images {
            width: 300px;
            height: 250px;
            background: rgba(255, 74, 47, 0.35);
            float: left;
            margin: 0 0 40px 20px;
            position: relative;
        }

        .images:nth-of-type(4n + 1) {
            margin: 0 0 40px 0!important;
        }

        .images img {
            width: 280px;
            height: 200px;
            margin: 10px;
        }

        .images a {
            text-decoration: none;
            color: #000000;
            text-align: center;
            display: block;
            height: 30px;
            background: #ff4a2f;
            font-weight: bold;
            line-height: 30px;
        }

        #drop {
            width: 298px;
            height: 250px;
            border: 1px solid #ccc;
            float: left;
            margin: 0 0 40px 20px;
            font-size: 180px;
            line-height: 200px;
            text-align: center;
            color: #6f6f6f;
            user-select: none;
        }

        .drop-inf {
            height: 276px!important;
        }

        .up {
            font-size: 30px;
            position: absolute;
            top: 110px;
            left: 15px;
            width: 30px;
            height: 30px;
            background: #c6c8ca!important;
            opacity: 0.5;
        }

        .down {
            font-size: 30px;
            position: absolute;
            top: 110px;
            right: 15px;
            width: 30px;
            height: 30px;
            background: #c6c8ca!important;
            opacity: 0.5;
        }

        #nav {
            width: 1260px;
            margin: 0 auto;
            margin-bottom: 20px;
        }

        #nav li {
            float: left;
            width: 50%;
            height: 36px;
            line-height: 36px;
            background: #FF4A2F;
            list-style: none;
            text-align: center;
        }

        #nav li a {
            text-decoration: none;
        }

        .title {
            width: 96%;
            height: 22px;
            margin: 0 10px 4px 10px;
        }

        .title input {
            height: 22px;
            width: 80%;
            text-indent: 5px;
        }

        .title button {
            width: 16%;
            height: 22px;
        }
    </style>
</head>
<body>

<div id="nav" class="cf">
    <ul>
        <li><a href="{{URL::action('IndexController@view')}}">Banner manager</a></li>
        <li><a href="{{URL::action('InformationController@information')}}">Information manager</a></li>
    </ul>
</div>

@yield('content')

<script src="{{ asset('js/app.js') }}"></script>
@stack('js')
</body>
</html>