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

  京都
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
        <div id="app">
            <div class="m-auto w-50 m-5 p-5">
                <div id='calendar'></div>
            </div>
        </div>

        
        <div  class="container">
            <table class="table ">
              <thead>
                <tr class="success">
                  <th>会場</th>
                  <th>講座期間</th>
                  <th>予約状況</th>
                  <th>予約人数</th>
                </tr>
              </thead>

              <form action="{{route('reservation_register_check')}}" method="POST"　>
                {{ csrf_field() }}

                @if (!@empty($new_reservation))
               
                {{-- <form action="https://www.google.com/?hl=ja"> --}}

                <tbody>
                    @foreach ($new_reservation as $data)

                    <input type="hidden" name="id" value="{{$data->id}}" />
         　　　　　　
                    <tr>
                        @switch($data->place)
                            @case(2)
                                <th>非会員用</th>
                                @break
                            @case(11)
                                <th>三重県</th>
                                @break
                            @case(21)
                                <th>京都府</th>
                            @break
                            @default
                                <th>会員用</th>
                                
                        @endswitch
                      {{-- <th>三重県</th> --}}
                      <td>{{$data->start_date}}　〜　{{$end_date[$data->id] ?? ''}} </td>
                      @if ($empty_seat[$data->id] != 0)
                      <th>残り座席{{$empty_seat[$data->id]}}人</th>
                      {{-- <td><a href="/reservation/check/{{$data->id}}/"><button>残り座席{{$empty_seat[$data->id]}}人</button></a></td> --}}
                      @else
                      <td>定員満員のため予約不可</td>
                      @endif

                      @if ($empty_seat[$data->id] != 0)

                      <th><select class="form-select" name="count1" id="count1">
                        @switch($empty_seat[$data->id])

                            @case(1)
                                <option value="1">1人</option>
                                @break
                            @case(2)
                                <option value="1">1人</option>
                                <option value="2">2人</option>
                                
                                @break
                            @case(3)
                            <option value="1">1人</option>
                              <option value="2">2人</option>
                              <option value="3">3人</option>
                                
                                @break 
                            @case(4)
                            <option value="1">1人</option>
                            <option value="2">2人</option>
                            <option value="3">3人</option>
                            <option value="4">4人</option>
                                
                                @break  
                            @default
                              <option value="1">1人</option>
                              <option value="2">2人</option>
                              <option value="3">3人</option>
                              <option value="4">4人</option>
                              <option value="5">5人</option>
                                
                        @endswitch
                        
                        </select>
                       </th>

                          
                      @endif
                     
                    </tr>
                    @endforeach

                  </tbody>

                 


                  

                  <div class="container">
                    <div class="row">
                      <div class="col text-center">
                        <button class="btn btn-default"　type="submit">顧客情報入力画面へ</button>
                      </div>
                    </div>
                  </div>
                    
               
               <br>
                    
                @endif

            </form>

              
            </table>
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
                  
                    events: "/setEvents/kyouto",
                 
                 });
                 calendar.render();
            });
        </script>
    </body>
</html>