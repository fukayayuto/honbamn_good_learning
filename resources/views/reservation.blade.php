<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    　　　<title>learning</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    <link rel="stylesheet" href="css/monthly.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    {{-- 　　カレンダー用 --}}
    <script src='/js/fullcalendar/core/main.js'></script>
    <script src='/js/fullcalendar/daygrid/main.js'></script>
    <script src='/js/fullcalendar/interaction/main.js'></script>

    <script src="/js/ajax-setup.js"></script>
    <script src='/js/fullcalendar.js'></script>
    <script src='/js/event-control.js'></script>
    {{-- ここ上の3個はあとで使います。ファイルを作成した後、あらかじめ読み込んでおきます。 --}}

    <link href='/css/fullcalendar/core/main.css' type="text/css" rel='stylesheet' />
    <link href='/css/fullcalendar/daygrid/main.css' type="text/css" rel='stylesheet' />

    <link href='{{ asset(' fullcalendar-5.10.1/lib/main.css') }}' rel='stylesheet' />
    <script src='{{ asset(' fullcalendar-5.10.1/lib/main.js') }}'></script>


</head>

<body>
    {{-- @if (!empty(Auth::id()))
    会員用
    @else
    非会員用
    @endif --}}
    {{-- <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">予約日時選択</div>
            <div class="panel-body">
                <form action="{{ route('reservation_create')}}" method="POST">
                    {{ csrf_field() }}
                    　 <input type="hidden" name="count" value="{{$count}}">
                    <div class="form-group">
                        <label class="control-count">人数 {{$count}}人</label>
                    </div>

                    {{-- <div class="form-group">
                        <label class="control-count">日付</label>
                        <input type="date" name="reservation_date"></input>
                    </div> --}}
{{-- 
                    <button class="btn btn-primary">次へ</button><br>
                </form>
            </div>
            　
        </div>
    </div>
    </div>  --}}


    {{-- カレンダー表示 --}}
    <div id="app">
        <div class="m-auto w-50 m-5 p-5">
            <div id='calendar'></div>
        </div>
    </div>

    {{-- <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/monthly.js"></script>
    <script type="text/javascript" src="js/schedule.js"></script> --}}
</body>

</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'ja',
                    height: 'auto',
                    firstDay: 1,
                    headerToolbar: {
                        left: "dayGridMonth,listMonth",
                        center: "title",
                        right: "today prev,next"
                    },
                    buttonText: {
                        today: '今月',
                        month: '月',
                        list: 'リスト'
                    },
                    noEventsContent: 'スケジュールはありません',
                    
                    // for (let key in data[0]) {
                    //     console.log(key);
                    //     console.log(data[0][key]);
                    // }
                    
                
                    // events: [
                    //     {
                    //         title: 'イベント',
                    //         start: '2021-11-10',
                    //         end: '2021-11-12'
                    //     }
                    // ],
                    events: "/setEvents",
                    
                    // {
                    //     title: 'Long Event',
                    //     start: '2021-11-07',
                    //     end: '2021-11-10',
                    //     // url: '#',
                    // },
                    // {
                    //     title: '三重県',
                    //     start: '2021-11-07',
                    //     end: '2021-11-10',
                    // },
                   
                 });
                 calendar.render();
            });
</script>