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

</head>

<body>

  <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading">予約日時選択</div>
      <div class="panel-body">
        {{-- <form action="{{ route('reservation_create')}}" method="POST"> --}}
          <form action="#" method="POST">
            {{ csrf_field() }}
            　<input type="hidden" name="count" value="{{$count}}">
            <div class="form-group">
              <label class="control-count">人数 {{$count}}人</label>
            </div>
          </form>

          {{-- カレンダー --}}
          {{-- <div class="form-group">
            <label class="control-count">日付</label>
            <input type="date" name="reservation_date"></input>
          </div> --}}


          <div class="container">
            <table class="table ">
              <thead>
                <tr class="success">
                  <th>会場</th>
                  <th>開始日</th>
                  <th>講座必要日</th>
                </tr>
              </thead>


              <tbody>
                @foreach ($data as $d)
                　　　　　　
                <tr>


                  <th>三重県</th>

                  <td>{{$d->start_date}}</td>
                  <td>{{$d->progress}}日</td>
                  @if ($empty_seat[$d->id] != 0)
                  <td><a href="/reservation/check/{{$d->id}}/{{$count}}"><button>予約 :
                        残り座席{{$empty_seat[$d->id]}}人</button></a></td>
                  @else
                  <td>定員満員のため予約不可</td>
                  @endif
                </tr>
              </tbody>

              @endforeach
            </table>
          </div>
    </div>
  </div>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/monthly.js"></script>
  <script type="text/javascript" src="js/schedule.js"></script>
</body>

</html>