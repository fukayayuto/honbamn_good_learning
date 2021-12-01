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

    <a href="/management/reservation/index"><button>一覧に戻る</button></a>


    <div class="container">
        <form action="{{ route('reservation_detail_edit') }}" method="POST">
            @csrf
            <table class="table">
                <thead>
                    <tr class="success">
                        <td>ID</td>
                        <td>予約会場</td>
                        <td>開始日</td>
                        <td>所用日数</td>
                        <td>席数</td>
                        <td>作成日時</td>
                        <td>更新日時</td>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($data))
                        <tr>
                            <td>{{ $data->id }}</td>
                            <input type="hidden" name="id" value="{{ $data->id }}" id="id">
                            <td>
                                <select name="place" id="place">
                                    <option value="1" <?php if ($data->place == 1) {
    echo ' selected';
} ?>>会員</option>
                                    <option value="2" <?php if ($data->place == 2) {
    echo ' selected';
} ?>>非会員</option>
                                    <option value="11" <?php if ($data->place == 11) {
    echo ' selected';
} ?>>三重県</option>
                                    <option value="21" <?php if ($data->place == 21) {
    echo ' selected';
} ?>>京都府</option>
                                </select>
                            </td>
                            <td><input type="date" name="start_date" id="start_date" value="{{ $data->start_date }}" required>
                            </td>
                            <td><input type="number" name="progress" id="progress" min="1" max="100"
                                    value="{{ $data->progress }}" required>日</td>
                            <td><input type="number" name="count" id="count" min="1" max="100"
                                    value="{{ $data->progress }}" required>席</td>
                            <td>{{ $data->created_at }}</td>
                            <td>{{ $data->updated_at }}</td>
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
            <form action="/management/reservation/delete/{{ $data->id }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col text-center">
                        <button class="btn btn-default" 　type="submit">削除する</button>
                        <input type="hidden" name="del_flg" id="del_flg" value="1">
                    </div>
                </div>
            </form>
        </div>

    </div>
</body>

</html>
