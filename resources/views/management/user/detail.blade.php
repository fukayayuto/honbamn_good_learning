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

    <a href="/management/user/index"><button>一覧に戻る</button></a>


    <div class="container">
        <table class="table">
            <thead>
                <tr class="success">
                    <td>アカウント情報</td>
                    <td></td>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>氏名</td>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <td>メールアドレス</td>
                    <td>{{ $data->email }}</td>
                </tr>
                <tr>
                    <td>会社名</td>
                    <td>{{ $data->company_name }}</td>
                </tr>
                <tr>
                    <td>営業所</td>
                    <td>{{ $data->sales_office }}</td>
                </tr>
                <tr>
                    <td>電話番号</td>
                    <td>{{ $data->phone }}</td>
                </tr>
                <tr>
                    <td>作成日時</td>
                    <td>{{ $data->created_at }}</td>
                </tr>
                <tr>
                    <td>更新日時</td>
                    <td>{{ $data->updated_at }}</td>
                </tr>

            </tbody>
        </table>
    </div>

    <div class="container">
        <table class="table">
            @foreach ($entry_data as $data)
            
                <thead>
                    <tr class="info">
                        <td>予約状況</td>
                        <td></td>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>予約ID</td>
                        <td>{{$data['id']}}</td>
                    </tr>
                    <tr>
                        <td>会場</td>
                        <td>{{$data['place']}}</td>
                    </tr>
                    <tr>
                        <td>開始日</td>
                        <td>{{$data['start_date']}}</td>
                    </tr>
                    <tr>
                        <td>受講期間</td>
                        <td>{{$data['progress']}}日間</td>
                    </tr>
                    <tr>
                        <td>受講人数</td>
                        <td>{{$data['count']}}人</td>
                    </tr>
                    <tr>
                        <td>予約登録日時</td>
                        <td>{{$data['created_at']}}</td>
                    </tr>
                    <tr>
                        <td>予約更新日時</td>
                        <td>{{$data['updated_at']}}</td>
                    </tr>
                </tbody>

            @endforeach
        </table>
    </div>

</body>

</html>
