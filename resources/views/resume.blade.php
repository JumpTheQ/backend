<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
@foreach ($resume->sections()->get() as $section)
    <p></p>
    <p>{{ $section->content }}</p>
@endforeach
</body>
</html>
