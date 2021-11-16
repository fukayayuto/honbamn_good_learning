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

    <a href="/management/information/index"><button>一覧に戻る</button></a>

    <div class="container">
        <form action="{{ route('information_detail_edit') }}" method="POST">
            @csrf
            <table class="table">
                <thead>
                    <tr class="success">
                        <td>ID</td>
                        <td>URL</td>
                        <td>タイトル</td>
                        <td>URL部分</td>
                        <td>作成日時</td>
                        <td>更新日時</td>
                        <td>表示フラグ</td>
                    </tr>
                </thead>

                <tbody>
                    @if (!empty($data))
                        <tr>
                            <td>{{ $data->id }}</td>
                            <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                            <td><textarea name="link" id="link" cols="50" rows="3" required>{{ $data->link }}</textarea></td>
                            <td><textarea name="title" id="title" cols="50" rows="3" required>{{ $data->title }}</textarea>
                            <td><textarea name="link_part" id="link_part" cols="50" rows="3" required>{{ $data->link_part }}</textarea>
                            </td>
                            <td>{{ $data->created_at }}</td>
                            <td>{{ $data->updated_at }}</td>
                            <td>
                                @if ($data->display_flg == 1)
                                    <input type="checkbox" name="display_flg" id="display_flg" value="1" checked>
                                @else
                                <input type="checkbox" name="display_flg" id="display_flg" value="1">
                                @endif
                            </td>
                        </tr>
                    @endif

                </tbody>
            </table>



            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <button class="btn btn-default" 　type="submit">変更する</button>
                    </div>
                </div>
            </div>

        </form>


        <div class="container">
            <form action="/management/information/delete/{{ $data->id }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col text-center">
                        <input type="hidden" name="del_flg" id="del_flg" value="1">
                        <button class="btn btn-default" 　type="submit">削除する</button>
                        </a>
                    </div>
                </div>
            </form>
        </div>


    </div>
</body>

</html>
