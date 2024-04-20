<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
@foreach ($sections as $section)
    <p>{{ $section->content }}</p>
@endforeach
</body>
</html>
