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
        メールを送信する<br><br>
        <form method="POST" action="{{ route('select_mail_check') }}">
        {{-- <form method="POST" action="#"> --}}

            @csrf
           
            <div class="form-group">
                <label>宛先:</label>
                @foreach ($account_data as $item)
                    {{$item['name']}},
                    <input type="hidden" name="check[]" value="{{$item['id']}}">
                @endforeach
            </div>
           
            <div class="form-group">
                <label>件名</label>
                <input type="text" class="form-control" id="title" placeholder="件名" name="title">
            </div>
            <div class="mb-3">
                <label>本文</label>
                <textarea class="form-control" name="mail_text" rows="10"></textarea>
              </div>
            <button type="submit" class="btn btn-primary">確認画面へ</button>
        </form>
    </div>
</body>

</html>
