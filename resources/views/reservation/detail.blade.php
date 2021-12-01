<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}

            {{-- <div class="container">
                <div class="row">
                    <div class="col text-right">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                                ログアウト
                            </button>
                        </form>
                        {{$user->family_name}} {{$user->first_name}}様<br>
                    </div>
                </div>
            </div> --}}


        </h2>
    </x-slot>

    <div class="py-12">

    </div>


    <div class="container">
        <table class="table">
            <thead　class="table-primary">
                <tr class="success">
                    <td>予約内容詳細</td>
                    <td></td>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>予約期間</td>
                    <td>{{$start_date}}〜{{$end_date}}</td>
                </tr>
                <tr>
                    <td>予約人数</td>
                    <td>{{$data->count}}人</td>
                </tr>
            </tbody>

        </table>

        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <form action="/reservation/delete/{{$data->id}}" method="POST">
                        @csrf
                        <button class="btn btn-default" 　id="btn" 　type="submit">予約をキャンセルする</button>
                    </form>
                </div>
            </div>
        </div>
        　　　
    </div>

    <script>
     
    
    </script>


    {{-- <a href="/count_0"><button class="btn btn-secondary">非会員</button></a> --}}


    {{-- <a href="/reservation/customer/select"><button class="btn btn-secondary">予約</button></a> --}}

</x-app-layout>

{{-- <form action="{{route('reservation_index')}}" method="POST">
    {{ csrf_field() }}
    {{-- <input type="hidden" name="user_id" value="{{Auth::id()}}"> --}}
    {{-- <button class="btn btn-primary">会員</button>
</form> --}}