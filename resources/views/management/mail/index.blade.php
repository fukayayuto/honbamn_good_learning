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

    <a href="/management/index"><button>管理画面一覧に戻る</button></a><br>
    <a href="/management/mail/history/index"><button>メール履歴表示</button></a>
   



    <div class="container">
        <table class="table">
            <thead>
                <tr class="table-secondary">
                    <td></td>
                    <td>氏名</td>
                    <td>メールアドレス</td>
                    <td>会社名</td>
                </tr>
            </thead>

            <tbody>
                <a href="/management/mail/select/index"><button> 全員に一斉メールを送信する</button></a>
                <form action="{{route('select_mail_index')}}" method="POST">
                    @csrf
                    <button type="submit"> 選択したユーザーにメールを送信する</button>
                   
                    @foreach ($data as $item)
                        <tr>
                            <td><input type="checkbox" id="check" name="check[]" value="{{ $item->id }}"></td>
                            <td><a href="/management/user/detail/{{$item->id}}/0">{{ $item->name }}</a></td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->company_name }}</td>
                        </tr>
                    @endforeach
               </form>
            </tbody>
        </table>
    </div>
</body>
<script>

    // var btn = document.getElementById('btn');
    
    // btn.addEventListener('click', function() {
    //     let result = confirm('本当に送信しますか？');
    //         if (result) {
    //         alert("送信しました");
    //         } else {
    //         alert("送信しませんでした");
    //         }

    // })

    

   

</script>


</html>
