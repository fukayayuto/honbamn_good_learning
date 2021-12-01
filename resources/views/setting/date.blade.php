<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
    予定日時設定画面
    

    <div  class="container">
        <table class="table ">
          <thead>
            <tr class="success">
              <th>会場</th>
              <th>開始日時</th>
              <th>講座必要日時</th>
              <th>座席数</th>
              <th><a href="/setting/add"><button>新規作成</button></a></th>
            </tr>
          </thead>
          

          <tbody>
            @foreach ($data as $d)

            <tr>
              <th>{{$d->place}}</th>
              <td>{{$d->start_date}}</td>
              <td>{{$d->progress}}</td>
              <td>{{$d->count}}</td>
              <td><a href="/setting/reservation/{{$d->id}}"><button>変更</button></a></td>
            </tr>
          </tbody>

           @endforeach
        </table>
      </div>
    

</body>
</html>