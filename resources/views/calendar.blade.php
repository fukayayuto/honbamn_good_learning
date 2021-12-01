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
    </head>
    <body>
        <div id="app">
            <div class="m-auto w-50 m-5 p-5">
                <div id='calendar'></div>
            </div>
        </div>

        <link href='{{ asset('fullcalendar-5.10.1/lib/main.css') }}' rel='stylesheet' />
        <script src='{{ asset('fullcalendar-5.10.1/lib/main.js') }}'></script>
        <script>


            var data = @json($data);　// ここ
            // console.log(data);//yamada
            // console.log(data[0]);
            // console.log(data[0]['description']);


    

            for (const elem of data) {

                for (let key in elem) {
                    console.log(key);
                    console.log(elem[key]);
                }
               
            }


            

            // for (let key in data[0]) {
            //     console.log(key);
            //     console.log(data[0][key]);
            // }

            
// document.addEventListener('DOMContentLoaded', function() {
//     var calendarEl = document.getElementById('calendar');

//     var calendar = new FullCalendar.Calendar(calendarEl, {
//         plugins: [ 'interaction', 'dayGrid' ],
//         //プラグイン読み込み
//         defaultView: 'dayGridMonth',
//         //カレンダーを月ごとに表示
//         editable: true,
//         //イベント編集
//         firstDay : 1,
//         //秋の始まりを設定。1→月曜日。defaultは0(日曜日)
//         eventDurationEditable : false,
//         //イベントの期間変更
//         selectLongPressDelay:0,
//         // スマホでタップしたとき即反応
//         events: [
//             {
//                 title: 'イベント',
//                 start: '2021-11-01',
//                 end : '2021-11-21'
//             }
//         ],
//         //一旦イベントのサンプルを表示。動作確認用。

//         eventDrop: function(info){
//         //eventをドラッグしたときの処理
//              //editEventDate(info);
//             //あとで使う関数
//         },

//         dateClick: function(info) {
//         //日付をクリックしたときの処理
//             //addEvent(calendar,info);
//             //あとで使う関数
//         },
//     });
//     calendar.render();
// });




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
    </body>
</html>