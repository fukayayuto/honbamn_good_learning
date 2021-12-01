

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <title>Document</title>
</head>

<body>

    <div class="container">

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- <div>
                <x-jet-label for="family_name" value="{{ __('family_name') }}" />
                <x-jet-input id="family_name" class="block mt-1 w-full" type="text" name="family_name" required autofocus />
            </div>

            <div>
                <x-jet-label for="name" value="{{ __('name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div>
                <x-jet-label for="company_name" value="{{ __('Company Name') }}" />
                <x-jet-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" required autofocus autocomplete="name" />
            </div>

            <div>
                <x-jet-label for="sales_office" value="{{ __('Sales Office') }}" />
                <x-jet-input id="sales_office" class="block mt-1 w-full" type="text" name="sales_office" />
            </div>

            <div>
                <x-jet-label for="phone" value="{{ __('Phone') }}" />
                <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" required autofocus />
            </div> --}}

            <div class="form-group">
                <label>氏名</label>
                <input type="text" class="form-control" id="name" placeholder="氏名" name="name" required>
            </div>
            <div class="form-group">
                <label>メールアドレス</label>
                <input type="email" class="form-control" id="email" placeholder="メールアドレス" name="email" required>
            </div>
            <div class="form-group">
                <label>パスワード</label>
                <input type="password" class="form-control" id="password" placeholder="パスワード" name="password" required>
            </div>
            <div class="form-group">
                <label>パスワード(確認用)</label>
                <input type="password" class="form-control" id="password_confirmation" placeholder="パスワード(確認用)" name="password_confirmation" required>
            </div>
            <div class="form-group">
                <label>会社名</label>
                <input type="text" class="form-control" id="company_name" placeholder="会社名" name="company_name" required>
            </div>
            <div class="form-group">
                <label>営業所</label>
                <input type="text" class="form-control" id="sales_office" placeholder="営業所" name="sales_office" required>
            </div>
            <div class="form-group">
                <label>電話番号</label>
                <input type="text" class="form-control" id="phone" placeholder="電話番号" name="phone" required>
                <small id="phoneHelp" class="form-text text-muted">ハイフンなしで入力してください</small>
            </div>
            <button type="submit" class="btn btn-primary">新規登録</button>
        </form>
    </div>
</html>

            {{-- @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif --}}
{{-- 
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                
            </div> --}}
       

