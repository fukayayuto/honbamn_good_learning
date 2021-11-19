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

    <title>Document</title>
</head>

<body>
    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('nomember_account_create') }}">
            @csrf
            <input type="hidden" name="count" value="{{ $count }}">
            <input type="hidden" name="reservation_id" value="{{ $reservation_id }}">
            <input type="hidden" name="user_flg" value=0>
            
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
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>
