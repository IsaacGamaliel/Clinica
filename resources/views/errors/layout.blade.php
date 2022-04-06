<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: skyblue;
            color: #fff;
            font-family: 'Nunito', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 36px;
            padding: 20px;
        }

        .img {
            background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/210284/four.gif");
            background-size: cover;
            background-position: center;
            position: absolute;
            top: 0px;
            right: 0px;
            bottom: 0px;
            left: 0px;
        }

        #fourohfour {
            width: 100%;
            height: 100%;
            color: white;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        #fourohfour .text {
            background-image: radial-gradient(50% 50%, ellipse closest-corner, rgba(0, 0, 0, 0) 1%, #000000 100%);
            width: 100%;
            height: 100%;
            text-align: center;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        #fourohfour .text h1 {
            font-size: 30px;
            padding-top: 230px;

            background-repeat: no-repeat;
            background-position: center 120px;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title">
                @yield('message')
            </div>
        </div>
    </div>
</body>

</html>