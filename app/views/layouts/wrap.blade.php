<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <script src="/js/jquery-1.10.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/kube.css">
	<link rel="stylesheet" type="text/css" href="/css/cart.css">
    <style>
        body {
            margin:0;
            font-family:'Lato', sans-serif;
            text-align:center;
            color: #999;
        }
        a, a:visited {
            text-decoration:none;
        }

        h1 {
            font-size: 32px;
            margin: 16px 0 0 0;
        }
        #wrap{
            width:80%;
            max-width:500px;
            margin:auto;
        }
        table{
            margin-bottom:10px !important;
        }
    </style>
 @yield('head')
</head>
<body>
<div id="wrap">
 @yield('body')
</div>
</body>
</html>
