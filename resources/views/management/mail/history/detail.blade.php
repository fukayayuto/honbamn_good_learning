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
            送信内容<br>

            <label>宛先:</label>
            <label>{{$adress}}</label><br>            
           
            <label>件名:</label>
            <label>{{$title}}</label><br>

            <label>本文:</label>
            <label style="white-space: pre-wrap;">{{$mail_text}}</label><br>

            <a href="/management/mail/history/index"><button class="btn btn-primary">戻る</button></a>
    </div>
</body>

</html>
