<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    予約確認画面<br>

　　 予約日時詳細<br>

    ・予約人数:{{$count}}人<br>
    ・講座開始日:{{$data['start_date']}}<br>
    ・講座会場:{{$data['place']}}<br>


　　 アカウント詳細<br>

    ・氏名:{{$user['family_name']}}{{$user['first_name']}}<br>
    ・会社名:{{$user['company_name']}}<br>


    <form action="{{route('reservation_register_second')}}" method="POST">
        {{ csrf_field() }}
    　<input type="hidden" name="user_id" value="{{$user['id']}}">
      <input type="hidden" name="reservation_id" value="{{$data['id']}}">
      <input type="hidden" name="count" value="{{$count}}">


    

      <button>登録</button>
    </form>
  　
    
    

</body>
</html>