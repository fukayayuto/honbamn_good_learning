


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <title>トラックドライバー教育のクラウド型eラーニング【グッドラーニング!】</title>
</head>

<body>
    <div class="container">
        <form action="{{route('truck_reservation_store')}}" method="POST">
            @csrf
            <input type="hidden" name="reservation_id" value="{{$data['reservation_id']}}">
            <input type="hidden" name="reservation_name" value="{{$data['reservation_name']}}">
            <input type="hidden" name="count" value="{{$data['count']}}">
            <input type="hidden" name="name" value="{{$data['name']}}">
            <input type="hidden" name="email" value="{{$data['email']}}">
            <input type="hidden" name="company_name" value="{{$data['company_name']}}">
            @if (!empty($data['sales_office']))
                <input type="hidden" name="sales_office" value="{{$data['sales_office']}}">
            @endif
            <input type="hidden" name="phone" value="{{$data['phone']}}">

            <h2>受講予約確認画面</h2><br>

            <label>受講名:</label>：
            {{$data['reservation_name']}} <br>
            <label>受講期間:</label>
            {{$data['start_date']}}〜{{$data['end_date']}}<br>
            <label>予約人数:</label>：
            {{$data['count']}}人 <br>
            <label>申込者名:</label>：
            {{$data['name']}} 様<br>
            <label>メールアドレス:</label>：
            {{$data['email']}} <br>
            <label>会社名:</label>：
            {{$data['company_name']}} <br>
            <label>営業者名:</label>：
            {{$data['sales_office']}} <br>
            <label>電話番号:</label>：
            {{$data['phone']}} <br>

            <button type="submit" class="btn btn-primary">登録する</button>

        </form>
    </div>
</body>

</html>
