<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{asset('/layout/images/favicon.ico')}}" />

    <!-- Bootstrap -->
    <link href="{{asset('/layout/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/layout/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('/layout/css/response.css')}}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    &#45;&#45;&lt;!&ndash;<script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>&ndash;&gt;&#45;&#45;
   &#45;&#45;&lt;!&ndash;<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>&ndash;&gt;&#45;&#45;
    <![endif]-->
</head>
<body>
@section('body')
@show
</body>
</html>