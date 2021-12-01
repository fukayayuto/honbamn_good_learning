<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
　　　<title>learning</title>
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>



    <div class="container">
        <div class="panel panel-default">
          <div class="panel-heading">予約日時追記</div>
          <div class="panel-body">
            <form action="/setting/add" method="POST">
            {{-- <form action="#" method="POST"> --}}
                {{ csrf_field() }}
                <input type="hidden" name="id">
                <div class="form-group">
                <label class="control-label">会場</label>
                <select class="form-control" name="place">
                    <option value="1" name="place">デフォルト（会員用）</option>
                    <option value="11" name="place">デフォルト（非会員用）</option>
                    <option value="2" name="place">三重県</option>
                    <option value="3" name="place">京都府</option>
                </select>
                {{-- <input class="form-control" type="number" name="place" value="{{$data->place}}"> --}}
              </div>
              <div class="form-group">
                <label class="control-label">開始日時 </label>
                <input class="form-control" type="date" name="start_date">
              </div>
              <div class="form-group">
                <label class="control-label">所要日数 </label>
                <input class="form-control" type="number" name="progress" >
              </div>
              <div class="form-group">
                <label class="control-label">定員数 </label>
                <input class="form-control" type="number" name="count">
              </div>

              
              <button class="btn btn-primary">新規作成</button>
            </form>
          </div>
        </div>
      </div>
</body>
</html>