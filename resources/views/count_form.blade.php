<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
　　　<title>learning</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>    
    <link rel="stylesheet" href="css/monthly.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

</head>
<body>
  @if (!empty(Auth::id()))
    @if (!empty($flg))
      非会員用
    @else
        会員用
    @endif
  @else
      非会員用
  @endif
    <div class="container">
        <div class="panel panel-default">
          <div class="panel-heading">人数選択</div>
          <div class="panel-body">
            <form action="{{ route('reservation_select')}}" method="POST">
            {{-- <form action="#" method="POST"> --}}
                {{ csrf_field() }}
              <div class="form-group">
                <label class="control-count">人数</label>
                <select name="count">
                    <option value="1">1人</option>
                    <option value="2">2人</option>
                    <option value="3">3人</option>
                    <option value="4">4人</option>
                    <option value="5">5人</option>
                </select>
              </div>
              {{-- <div class="form-group">
                <label class="control-count">日付</label>
                <input type="date" name="reservation_date"></input>
              </div> --}}

              <button class="btn btn-primary">次へ</button><br><br>

            </form>
              	
            {{-- <div class="monthly" id="mycalendar"></div> --}}

            <a href="#"><button class="btn btn-secondary">三重にて予約する</button></a><br>
              
            <a href="#"><button class="btn btn-secondary">京都にて予約する</button></a><br>

              
           
        　　</div>
          </div>
      </div>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/monthly.js"></script>
    <script type="text/javascript" src="js/schedule.js"></script>
</body>

</html>

