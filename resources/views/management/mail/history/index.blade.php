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

    <a href="/management/mail/index"><button>管理画面一覧に戻る</button></a>


    <div class="container">
        <table class="table">
            <thead>
                <tr class="table-secondary">
                    <td>種類</td>
                    <td>日付</td>
                    <td>宛先</td>
                    <td>内容</td>
                </tr>
            </thead>

            <tbody>
               @foreach ($data as $item)
                   <tr>
                       <td>{{$item['type']}}</td>
                       <td>{{$item['created_at']}}</td>
                       <td><a href="/management/mail/history/send/{{$item['content_id']}}">{{$item['adress']}}</a></td>
                       <td><a href="/management/mail/history/index/{{$item['content_id']}}">{{$item['email_content']}}</a></td>
                   </tr>
                   
               @endforeach
            </tbody>
        </table>
    </div>
</body>


</html>
