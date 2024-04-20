<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #F2E9F4;
        }
        .header .avatar {
            border-radius: 9999px;
        }
        .container {
            max-width: 960px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <img src="{{ $user->avatar_url }}" alt="">
        </div>
    </div>
</body>
</html>
