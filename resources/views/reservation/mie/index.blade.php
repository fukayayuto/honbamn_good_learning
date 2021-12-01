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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
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

        三重県専用
        {{-- <div class="card"　style="margin-bottom: 300px;">
            <div class="card-body">
              <p class="card-text">予約人数選択</p>
              <p class="card-text">
                  <select name="count" id="count">
                    <option value="1">1人</option>
                    <option value="2">2人</option>
                    <option value="3">3人</option>
                    <option value="4">4人</option>
                    <option value="5">5人</option>
                  </select>
              </p>
            </div>
        </div> --}}

        {{-- カレンダー表示 --}}

        <select class="form-select" name="count" id="count">
          <option hidden>選択してください</option>
          <option value="1">1人</option>
          <option value="2">2人</option>
          <option value="3">3人</option>
          <option value="4">4人</option>
          <option value="5">5人</option>
        </select>
       

        <div id="app">
            <div class="m-auto w-50 m-5 p-5">
                <div id='calendar'></div>
            </div>
        </div>

        
        <div  class="container">
            <form action="{{route('mie_reservation_store')}}" method="POST" name="form">
              @csrf
              <table class="table " id="targetTable">
                <thead>
                  <tr class="success">
                    <td>講座期間</td>
                    <td>予約人数</td>
                    <td hidden>ID</td>
                  </tr>
                </thead>
                
              </table>
                <div  class="container">
                      <button id="button">次へ</button>
              </div>
            </form>
          </div>

          





        <link href='{{ asset('fullcalendar-5.10.1/lib/main.css') }}' rel='stylesheet' />
        <script src='{{ asset('fullcalendar-5.10.1/lib/main.js') }}'></script>
       
       <script>

        document.addEventListener('DOMContentLoaded', function() {
          var calendarEl = document.getElementById('calendar');
          document.getElementById("button").style.display ="none";

          var calendar = new FullCalendar.Calendar(calendarEl, {
            
            initialDate: '2021-11-15',
            events: '/setEvents/mieken',
          });

          // calendar.render();
        });


            $(function() {
 
          //セレクトボックスが切り替わったら発動
          $('select').change(function() {

            var calendarEl = document.getElementById('calendar');
            var count = document.getElementById('count').value;
                var calendar = new FullCalendar.Calendar(calendarEl, {

                  eventClick: function(info) {
              var eventObj = info.event;

              if (eventObj.url) {
                alert(
                  'Clicked ' + eventObj.title + '.\n' +
                  'Will open ' + eventObj.url + ' in a new tab'
                );

                window.open(eventObj.url);

              } else {
                alert('Clicked ');
                var id = eventObj.id;

                $.ajax({
               type: "get", //HTTP通信の種類
               url:'/reservation/list/' +id, //通信したいURL
               dataType: 'json'
               })
               //通信が成功したとき
               .done((res)=>{
                 var reservatin_id = res[0]['id'];
                 var start_date = res[0]['start_date'];
                 var count = document.getElementById('count').value;

                 let table = document.getElementById('targetTable');
                 let newRow = table.insertRow();

                 let newCell = newRow.insertCell();
                 let newText = document.createTextNode(start_date);
                 newCell.appendChild(newText);

                 newCell = newRow.insertCell();
                 newText = document.createTextNode(count + '人');
                 newCell.appendChild(newText);

                 document.getElementById("button").style.display ="block";

                 var reservation_id_1 = document.getElementById('reservation_id_1');

                 if (!reservation_id_1) {
                  make_hidden('reservation_id_1', res[0]['id'],'form','reservation_id_1');
                  make_hidden('count_1',count ,'form','count_1');
                  
                 }else{
                  make_hidden('reservation_id_2', res[0]['id'],'form','reservation_id_2');
                  make_hidden('count_2',count ,'form','count_2');
                 }

               })
               //通信が失敗したとき
               .fail((error)=>{
                   console.log(error.statusText);
                   console.log('error');
               })      

              }
            },
                  
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
                  
                    events: '/setEvents/mieken/count/' + count,
                 
                 });
                 calendar.render();
            });
});

function make_hidden(name, value, formname,id) {
    var q = document.createElement('input');
    q.type = 'hidden';
    q.name = name;
    q.id = id;
    q.value = value;
    if (formname) {
    	if ( document.forms[formname] == undefined ){
    		console.error( "ERROR: form " + formname + " is not exists." );
    	}
    	document.forms[formname].appendChild(q);
    } else {
    	document.forms[0].appendChild(q);
    }
}



        </script>
    </body>
</html>