<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
@foreach ($coverLetter->sections()->orderBy('order', 'asc')->get() as $section)
    <p data-section-id="{{ $section->id }}">{{ $section->content }}</p>
@endforeach
</body>
</html>
