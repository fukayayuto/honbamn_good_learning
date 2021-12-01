<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <title>Document</title>
</head>

<body>

    
    <form action="{{ route('reservation_mie_register_store') }}" method="POST">
        {{ csrf_field() }}
        <div class="container">
            <table class="table ">
                @foreach ($data as $k => $item)

                <input type="hidden" name="reservation_{{$k}}" value="{{$item['id']}}">
                <input type="hidden" name="count_{{$k}}" value="{{$item['count']}}">


                <thead>
                    <tr class="success">
                        <th>予約講座情報</th>
                        <th></th>
                    </tr>
                </thead>
                {{-- <input type="hidden" name="reservation" value="{{ $data }}"> --}}
                {{-- @if (!is_null($user_flg)) --}}
                    {{-- <input type="hidden" name="user_flg" value="{{ $user_flg }}"> --}}
                {{-- @endif --}}

                <tbody>                    
        
                    <tr>
                        <th>会場</th>
                        @switch($item['place'])
                            @case(1)
                                <th>会員用</th>
                            @break
                            @case(2)
                                <th>非会員用</th>
                            @break
                            @case(11)
                                <th>三重県</th>
                            @break
                            @case(21)
                                <th>京都府</th>

                            @break
                            @default

                        @endswitch
                    </tr>
                </tbody>

                <tbody>
                    <tr>
                        <th>講座開始日</th>
                        <th>{{ $item['start_date'] }}</th>
                    </tr>
                </tbody>

                <tbody>
                    <tr>
                        <th>所用日数</th>
                        <th>{{ $item['progress'] }}日</th>
                    </tr>
                </tbody>

                <tbody>
                    <tr>
                        <th>予約人数</th>
                        <th>{{ $item['count'] }}人</th>
                    </tr>
                </tbody>

                @endforeach

            </table>

            <table class="table ">
                <thead>
                    <tr class="success">
                        <th>顧客情報</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th>名前</th>
                        <th>{{ $user->name }}様</th>
                    </tr>
                </tbody>

                <tbody>
                    <tr>
                        <th>メールアドレス</th>
                        <th>{{ $user->email }}</th>
                    </tr>
                </tbody>

                <tbody>
                    <tr>
                        <th>会社名</th>
                        <th>{{ $user->company_name }}</th>
                    </tr>
                </tbody>

                <tbody>
                    <tr>
                        <th>営業所名</th>
                        <th>{{ $user->sales_office }}</th>
                    </tr>
                </tbody>

                <tbody>
                    <tr>
                        <th>電話番号</th>
                        <th>{{ $user->phone }}</th>
                    </tr>
                </tbody>

            </table>
        </div>
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <button class="btn btn-default" 　type="submit">予約内容を登録する</button>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
