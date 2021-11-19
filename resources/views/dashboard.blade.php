<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}

            <div class="container">
                <div class="row">
                    <div class="col text-right">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                                ログアウト
                            </button>
                        </form>
                        {{$user->name}} 様<br>
                    </div>
                </div>
            </div>


        </h2>
    </x-slot>

    <div class="py-12">

    </div>

    <div class="container">
        <div class="row">
            <div class="col text-center">
                <a href="/reservation/index"><button class="btn btn-primary">初任運転者講習を予約する</button></a><br>
            </div>
        </div>
    </div>

    <div class="container">
        予約状況
        <table class="table">
            <thead　class="table-primary">
                <tr class="success">
                    <th>会場</th>
                    <th>講座開始日</th>
                    <th>所用日数</th>
                    <th>受講者人数</th>
                    <th></th>
                </tr>
            </thead>


            @foreach ($data as $item)
            <?php
            $place = (int) $item['place'];
            ?>
            <tbody>
                <tr>
                    @switch($place)
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
                    <th>{{$item['start_date']}}</th>
                    <th>{{$item['progress']}}日</th>
                    <th>{{$item['count']}}人</th>
                    <th><a href="/reservation/detail/{{$item['entry_id']}}"><button>詳細確認</button></a></th>
                    
                </tr>
            </tbody>

            @endforeach

        </table>
        　　　
    </div>

    <div class="container">
        NEWS & TOPICS
        <table class="table">
            <thead　class="table-primary">
                <tr class="success">
                    {{-- <th>タイトル</th>
                    <th>更新日時</th> --}}
                </tr>
            </thead>

            <tbody>

                @if (!empty($information_priority_data))
                    @foreach ($information_priority_data as $item)
                    <tr>
                        <th>{{$item['created_at']}}</th>
                        <th>
                            @if (isset($item['part_first']))
                                {{$item['part_first']}}
                            @endif

                            @if (isset($item['link_part']))
                                <a href="{{$item['link']}}">
                                    {{$item['link_part']}}
                                </a>
                            @else
                                    {{$item['title']}}
                            @endif
                        
                            @if (isset($item['part_final']))
                                {{$item['part_final']}}
                            @endif
                        </th>
                    </tr>
                    @endforeach
                    
                @endif


                @if (!empty($information_data))
                @foreach ($information_data as $item)
                    <tr>
                        <th>{{$item['created_at']}}</th>
                        <th>
                            @if (isset($item['part_first']))
                                {{$item['part_first']}}
                            @endif

                            @if (isset($item['link_part']))
                                <a href="{{$item['link']}}"　target="_blank">
                                    {{$item['link_part']}}
                                </a>
                            @else
                                    {{$item['title']}}
                            @endif
                        
                            @if (isset($item['part_final']))
                                {{$item['part_final']}}
                            @endif
                        </th>
                    </tr>
                @endforeach


                @endif

                {{-- <tr>
                    <th>2</th>
                    <th><a href="/infomation/detail/2">ここにタイトルが入ります。ここにタイトルが入ります。</a></th>
                    <th>2021-11-11</th>
                </tr>
                <tr>
                    <th>3</th>
                    <th><a href="/infomation/detail/3">ここにタイトルが入ります。</a></th>
                    <th>2021-11-10</th>
                </tr> --}}
            </tbody>



        </table>
        　　　
    </div>


    {{-- <a href="/count_0"><button class="btn btn-secondary">非会員</button></a> --}}


    {{-- <a href="/reservation/customer/select"><button class="btn btn-secondary">予約</button></a> --}}

</x-app-layout>

{{-- <form action="{{route('reservation_index')}}" method="POST">
    {{ csrf_field() }}
    {{-- <input type="hidden" name="user_id" value="{{Auth::id()}}"> --}}
    {{-- <button class="btn btn-primary">会員</button>
</form> --}}