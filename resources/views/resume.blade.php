<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700' rel='stylesheet'>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Montserrat';
        }
        .header {
            background-color: #F2E9F4;
        }
        .header .avatar {
            border-radius: 9999px;
            height: 72px;
            width: 72px;
            margin-right: 24px;
        }
        .header .info {
            min-width: 200px;
        }
        .header .info .name {
            font-size: 18px;
            font-weight: 700;
        }
        .header .info .email {
            font-size: 12px;
        }
        .header .info .skills {
            font-size: 12px;
            font-weight: 700;
            margin-top: 8px;
        }
        .header .about {
            font-size: 14px;
            margin-left: 24px;
        }

        .container {
            max-width: 720px;
            margin-left: auto;
            margin-right: auto;
        }

        .section {
            padding: 24px 0;
            font-size: 12px;
        }

        .section__header {
            font-size: 14px;
            font-weight: 700;
            white-space: nowrap;
        }
        .section__header__separator {
            display: block;
            width: 100%;
            margin-top: 14px;
            border: 1px solid #F2E9F4;
        }

        .flex {
            display: flex;
        }
        .py-6 {
            padding: 24px 0;
        }
        .mb-2 {
            margin-bottom: 8px;
        }
        .mb-4 {
            margin-bottom: 16px;
        }
        .w-full {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container py-6">
            <table>
                <tr>
                    <td style="vertical-align: top">
                        <img src="{{ $user->avatar_url }}" alt="" class="avatar">
                    </td>
                    <td style="vertical-align: top">
                        <div class="info">
                            <div class="name">{{ $user->name }}</div>
                            <div class="email">{{ $user->email }}</div>
                            <div class="skills" data-section-id="{{ $skills->id }}">
                                @foreach($skills as $skill)
                                    <span>#{{ $skill }}</span>
                                @endforeach
                            </div>
                        </div>
                    </td>
                    <td style="vertical-align: top">
                        <div class="about" data-section-id="{{ $about->id }}">
                            {{ $about }}
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="section">
                <table class="w-full mb-4">
                    <tr>
                        <td style="width: 100px"><div class="section__header">Experience</div></td>
                        <td><hr class="section__header__separator" /></td>
                    </tr>
                </table>
                @foreach($experiences as $experience)
                    <div class="mb-4">
                        <div><strong>{{ $experience['title'] }} @ {{ $experience['company'] }}</strong></div>
                        <div class="mb-2">{{ $experience['start_date'] }} to {{ $experience['end_date'] }}</div>
                        @if(array_key_exists('description', $experience))<div>{{ $experience['description'] }}</div>@endif
                    </div>
                @endforeach
            </div>
            @if(!empty($courses))
            <div class="section">
                <table class="w-full mb-4">
                    <tr>
                        <td style="width: 90px"><div class="section__header">Education</div></td>
                        <td><hr class="section__header__separator" /></td>
                    </tr>
                </table>
                @foreach($courses as $course)
                    <div class="mb-4">
                        <div><strong>{{ $course['name'] }}</strong></div>
                        <div class="mb-2">{{ $course['start_date'] }} to {{ $course['end_date'] }}</div>
                        @if(array_key_exists('description', $course))<div>{{ $course['description'] }}</div>@endif
                    </div>
                @endforeach
            </div>
            @endif
            @if(!empty($languages))
            <div class="section">
                <table class="w-full mb-4">
                    <tr>
                        <td style="width: 96px"><div class="section__header">Languages</div></td>
                        <td><hr class="section__header__separator" /></td>
                    </tr>
                </table>
                @foreach($languages as $language)
                    <div><strong>{{ $language['name'] }}</strong> - {{ $language['level'] }}</div>
                @endforeach
            </div>
            @endif
            @if(!empty($other))
                <div class="section">
                    <table class="w-full mb-4">
                        <tr>
                            <td style="width: 86px"><div class="section__header">Other info</div></td>
                            <td><hr class="section__header__separator" /></td>
                        </tr>
                    </table>
                </div>
                @foreach($other as $item)
                    <div class="mb-4">
                        <div><strong>{{ $item['title'] }} @ {{ $item['company'] }}</strong></div>
                        <div class="mb-2">{{ $item['start_date'] }} to {{ $item['end_date'] }}</div>
                        @if(array_key_exists('description', $item))<div>{{ $item['description'] }}</div>@endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</body>
</html>
