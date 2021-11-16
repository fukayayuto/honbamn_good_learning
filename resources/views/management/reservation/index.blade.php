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

    <a href="/management/index"><button>管理画面一覧</button></a>

    <div class="container">
        <form action="{{ route('reservation_store') }}" method="post">
            @csrf
            <select name="place" id="place">
                <option value="1">会員</option>
                <option value="2">非会員</option>
                <option value="11">三重県</option>
                <option value="21">京都府</option>
            </select>
            開始日：<input type="date" name="start_date" id="start_date" required>
            所用日数：<input type="number" name="progress" id="progress" min="1" max="100" required>
            席数：<input type="number" name="count" id="count" min="1" max="100" required>
            <button class="submit">新規登録</button>
        </form>
    </div>

    <br>
    <div class="container">
        <form action="/management/reservation/index" method="get">
            <input type="hidden" name="search" id="search" value="1">
            @if (!empty($search))

                @if (isset($search['place'])&& !empty($search['start_date']))
                    <select name="place" id="place">
                        <option value=""></option>
                        <option value="1" <?php if ($search['place'] == 1) {
    echo ' selected';
} ?>>会員</option>
                        <option value="2" <?php if ($search['place'] == 2) {
    echo ' selected';
} ?>>非会員</option>
                        <option value="11" <?php if ($search['place'] == 11) {
    echo ' selected';
} ?>>三重県</option>
                        <option value="21" <?php if ($search['place'] == 21) {
    echo ' selected';
} ?>>京都府</option>
                    </select>
                    <input type="date" name="start_date" value="{{ $search['start_date'] }}">

                @else

                    @if (isset($search['place']))
                        <select name="place" id="place">
                            <option value=""></option>
                            <option value="1" <?php if ($search['place'] == 1) {
    echo ' selected';
} ?>>会員</option>
                            <option value="2" <?php if ($search['place'] == 2) {
    echo ' selected';
} ?>>非会員</option>
                            <option value="11" <?php if ($search['place'] == 11) {
    echo ' selected';
} ?>>三重県</option>
                            <option value="21" <?php if ($search['place'] == 21) {
    echo ' selected';
} ?>>京都府</option>
                        </select>
                        <input type="date" name="start_date">
                    @endif

                    @if (!empty($search['start_date']))
                        <select name="place" id="place">
                            <option value=""></option>
                            <option value="1" <?php if ($search['place'] == 1) {
    echo ' selected';
} ?>>会員</option>
                            <option value="2" <?php if ($search['place'] == 2) {
    echo ' selected';
} ?>>非会員</option>
                            <option value="11" <?php if ($search['place'] == 11) {
    echo ' selected';
} ?>>三重県</option>
                            <option value="21" <?php if ($search['place'] == 21) {
    echo ' selected';
} ?>>京都府</option>
                        </select>
                        <input type="date" name="start_date" value="{{ $search['start_date'] }}">
                    @endif

                @endif

            @else
                <select name="place" id="place">
                    <option value=""></option>
                    <option value="1">会員</option>
                    <option value="2">非会員</option>
                    <option value="11">三重県</option>
                    <option value="21">京都府</option>
                </select>
                <input type="date" name="start_date">
            @endif
            <button class="submit">検索</button>
        </form>
        <a href="/management/reservation/index">
            <button>リセット</button>
        </a>
        
    </div>

    <br>

    <div class="container" id="users">
        <table class="table">
            <thead>
                <tr class="success">
                    <th>ID</th>
                    <th>予約会場</th>
                    <th class="sort" data-sort="id">開始日</th>
                    <th>終了日</th>
                    <th>所用日数</th>
                    <th>定員枠</th>
                    <th>残り定員枠</th>
                    <th>更新日時</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="list">
                @if (!empty($data))
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item['id'] }}</td>
                            @switch($item['place'])
                                @case(1)
                                    <td>会員</td>
                                @break
                                @case(2)
                                    <td>非会員</td>
                                @break
                                @case(11)
                                    <td>三重県</td>
                                @break
                                @case(21)
                                    <td>京都府</td>
                                @break
                                @default

                            @endswitch
                            <td id="id">{{ $item['start_date'] }}</td>
                            <td>{{ $item['end_date'] }}</td>
                            <td>{{ $item['progress'] }}日</td>
                            <td>{{ $item['count'] }}席</td>
                            <td>{{ $item['left_seat'] }}席</td>
                            <td>{{ $item['updated_at'] }}</td>
                            <td><a href="/management/reservation/detail/{{ $item['id'] }}"><button>編集</button></a>
                            </td>
                            <td><a href="/management/reservation/list/{{ $item['id'] }}"><button>エントリー表示</button></a>
                            </td>
                        </tr>
                    @endforeach
                @endif


            </tbody>
        </table>
    </div>
</body>
<script src="https://www.w3schools.com/lib/w3.js"></script>
    <script>
        var options = {
          valueNames: [ 'id', 'name']
        };
        
        var userList = new List('users', options);
        
        // 初期状態はidで昇順ソートする
        userList.sort( 'id', {order : 'asc' });
    </script>

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.1/js/jquery.tablesorter.min.js"> --}}


</html>
