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
                    @if (!empty($data->password))
                        <td>ユーザー情報</td>
                    @else
                        <td>アカウント情報</td>
                    @endif
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

</body>

</html>
