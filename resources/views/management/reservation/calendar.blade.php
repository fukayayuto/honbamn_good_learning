<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel × FullCalendar</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Script -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src='/js/fullcalendar/core/main.js'></script>
    <script src='/js/fullcalendar/daygrid/main.js'></script>
    <script src='/js/fullcalendar/interaction/main.js'></script>

    <script src="/js/ajax-setup.js"></script>
    <script src='/js/fullcalendar.js'></script>
    <script src='/js/event-control.js'></script>
    {{-- ここ上の3個はあとで使います。ファイルを作成した後、あらかじめ読み込んでおきます。 --}}

    <link href='/css/fullcalendar/core/main.css' type="text/css" rel='stylesheet' />
    <link href='/css/fullcalendar/daygrid/main.css' type="text/css" rel='stylesheet' />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>

<body>

    <a href="/management/index"><button>管理画面一覧</button></a>
    <a href="/management/reservation/index"><button>予約一覧表示</button></a>

    {{-- カレンダー表示 --}}
    <div class="container">
        <div id="app">
                <div id='calendar'></div>
        </div>
    </div>

    <link href='{{ asset('fullcalendar-5.10.1/lib/main.css') }}' rel='stylesheet' />
    <script src='{{ asset('fullcalendar-5.10.1/lib/main.js') }}'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'ja',
                height: 'auto',
                firstDay: 1,
                headerToolbar: {
                    left: "dayGridMonth",
                    center: "title",
                    right: "today prev,next"
                },
                buttonText: {
                    today: '今月',
                    month: '月',
                    // list: 'リスト'
                },
                noEventsContent: 'スケジュールはありません',

                events: "/setEvents/all",

            });
            calendar.render();
        });
    </script>
</body>

</html>
