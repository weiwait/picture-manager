<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', '图片管理器')</title>
    <style type="text/css">
        body {
            background: #f5f5f5;
        }

        * {
            margin: 0;
            padding: 0;
        }

        #contain {
            width: 1260px;
            margin: 0 auto;
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

        .up {
            font-size: 30px;
            position: absolute;
            top: 110px;
            left: 15px;
            width: 30px;
            height: 30px;
        }

        .down {
            font-size: 30px;
            position: absolute;
            top: 110px;
            right: 15px;
            width: 30px;
            height: 30px;
        }
    </style>
</head>
<body>
@yield('content')

<script src="{{ asset('js/app.js') }}"></script>
@stack('js')
</body>
</html>