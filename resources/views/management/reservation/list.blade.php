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
        <table class="table">

            <thead>
                <tr class="success">
                    <td>ID</td>
                    <td>会場</td>
                    <td>講座開始日</td>
                    <td>講座終了日</td>
                    <td>所要日程</td>
                    <td>定員枠</td>
                    <td>残り定員枠</td>
                    <td>作成日</td>
                    <td></td>
                </tr>
            </thead>



            <tbody>
                @if (!empty($reservation_data))

                    <tr>
                        <td>{{ $reservation_data['id'] }}</td>
                        @switch($reservation_data['place'])
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
                        <td>{{ $reservation_data['start_date'] }}</td>
                        <td>{{ $reservation_data['end_date'] }}</td>
                        <td>{{ $reservation_data['progress'] }}日</td>
                        <td>{{ $reservation_data['count'] }}人</td>
                        <td>{{ $reservation_data['used_seat'] }}人</td>
                        <td>{{ $reservation_data['created_at'] }}</td>
                        <td><a href="/management/reservation/detail/{{ $reservation_data['id'] }}">予約情報の変更</a></td>
                    </tr>

                @endif

            </tbody>
        </table>
    </div>


    <div class="container">
        <table class="table">

            <thead>
                <tr class="success">
                    <td>予約人数</td>
                    <td>エントリーID</td>
                    <td>ユーザーID</td>
                    <td>氏名</td>
                    <td>メールアドレス</td>
                    <td>会社名</td>
                    <td>営業所</td>
                    <td>電話番号</td>
                    <td>予約登録日時</td>
                </tr>
            </thead>



            <tbody>
                @if (!empty($data))

                    @foreach ($data as $val)
                        <?php
                        $color = 'table-warning';
                        if ($val['user_flg'] == 1) {
                        }else {
                            $color = 'table-secondary';
                        }
                        
                        ?>
                        <tr class=<?php echo $color; ?>>
                            <td>{{ $val['count'] }}人</td>
                            <td>{{ $val['id'] }}</td>
                            <td>
                                <a href="/management/user/detail/{{ $val['account_id'] }}">{{ $val['account_id'] }}
                                </a>
                            </td>
                            <td>{{ $val['name'] }}</td>
                            <td>{{ $val['email'] }}</td>
                            <td>{{ $val['company_name'] }}</td>
                            @if (!empty($val['sales_office']))
                                <td>{{ $val['sales_office'] }}</td>
                            @else
                                <td></td>
                            @endif

                            <td>{{ $val['phone'] }}</td>
                            <td>{{ $val['created_at'] }}</td>
                        </tr>
                    @endforeach

                @endif

            </tbody>
        </table>
    </div>
</body>

</html>
