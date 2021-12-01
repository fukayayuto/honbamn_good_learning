<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理画面</title>
</head>

<body>

    <div class="container">
        <br>
        確認画面<br><br>
        こちらの内容で送信しますか？
        <form method="POST" action="{{route('select_mail_send')}}">
            <input type="hidden" name="title" value="{{$title}}">
            <input type="hidden" name="mail_text" value="{{$mail_text}}">

            @csrf
           
            <label>宛先:</label>
            @foreach ($account_data as $item)
                {{$item['name']}},
                <input type="hidden" name="check[]" value="{{$item['id']}}">
            @endforeach
            <br>
           
            <label>件名:</label>
            <label>{{$title}}</label><br>

            <label>本文:</label>
            <label>{{$mail_text}}</label><br>

            <button type="submit" class="btn btn-primary">送信する</button>
        </form>
    </div>
</body>

</html>
