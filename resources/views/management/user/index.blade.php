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

    <a href="/management/index"><button>管理画面一覧に戻る</button></a>


    <div class="container">
        <table class="table">
            <thead>
                <tr class="table-secondary">
                    <td>ID</td>
                    <td>氏名</td>
                    <td>メールアドレス</td>
                    <td>会社名</td>
                    <td>営業所</td>
                    <td>電話番号</td>
                    <td>予約登録日時</td>
                </tr>
            </thead>

            <tbody>
                @foreach ($account_data as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td><a href="/management/user/detail/{{ $data->id }}">{{ $data->name }}</a></td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->company_name }}</td>
                        @if ($data->sales_office)
                            <td>{{ $data->sales_office }}</td>
                        @else
                            <td></td>
                        @endif
                        <td>{{ $data->phone }}</td>
                        <td>{{ $data->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
