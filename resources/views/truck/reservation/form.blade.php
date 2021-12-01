


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

        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <form method="POST" action="{{ route('truck_reservation_check') }}">
            @csrf
            <input type="hidden" name="reservation_id" value="{{ $data['id'] }}">
            <input type="hidden" name="reservation_name" value="{{ $data['name'] }}">
            <input type="hidden" name="start_date" value="{{ $data['start_date'] }}">
            <input type="hidden" name="end_date" value="{{ $data['end_date'] }}">
            <h2>受講予約画面</h2><br>

            <label>受講名:</label>：
            {{$data['name']}} <br>
            <label>受講期間:</label>
            {{$data['start_date']}}〜{{$data['end_date']}}<br>

            <div class="form-group">
                <label>人数選択</label>
                <select class="form-control" name="count" id="count">

                    @switch($left_seat)
                        @case(1)
                            <option value="1">1人</option>
                        @break
                        @case(2)
                            <option value="1">1人</option>
                            <option value="2">2人</option>
                        @break
                        @case(3)
                            <option value="1">1人</option>
                            <option value="2">2人</option>
                            <option value="3">3人</option>
                        @break
                        @case(4)
                            <option value="1">1人</option>
                            <option value="2">2人</option>
                            <option value="3">3人</option>
                            <option value="4">4人</option>
                        @break
                        @default
                            <option value="1">1人</option>
                            <option value="2">2人</option>
                            <option value="3">3人</option>
                            <option value="4">4人</option>
                            <option value="5">5人</option>
                    @endswitch

                </select>
            </div>
            
            <div class="form-group">
                <label>氏名</label>
                <input type="text" class="form-control" id="name" placeholder="氏名" name="name">
            </div>
            <div class="form-group">
                <label>メールアドレス</label>
                <input type="email" class="form-control" id="email" placeholder="メールアドレス" name="email">
            </div>
            <div class="form-group">
                <label>会社名</label>
                <input type="text" class="form-control" id="company_name" placeholder="会社名" name="company_name">
            </div>
            <div class="form-group">
                <label>営業所</label>
                <input type="text" class="form-control" id="sales_office" placeholder="営業所" name="sales_office">
            </div>
            <div class="form-group">
                <label>電話番号</label>
                <input type="text" class="form-control" id="phone" placeholder="電話番号" name="phone">
                <small id="phoneHelp" class="form-text text-muted">ハイフンなしで入力してください</small>
            </div>
            <button type="submit" class="btn btn-primary">確認画面へ</button>
        </form>
    </div>
</body>

</html>
