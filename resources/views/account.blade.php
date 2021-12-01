<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{route('reservation_check')}}">
            @csrf
            
            <div>
                <x-jet-label for="family_name" value="{{ __('family_name') }}" />
                <x-jet-input id="family_name" class="block mt-1 w-full" type="text" name="family_name" required autofocus />
            </div>

            <div>
                <x-jet-label for="first_name" value="{{ __('first_name') }}" />
                <x-jet-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"  required autofocus />
            </div>

            

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" required />
            </div>

            <div>
                <x-jet-label for="company_name" value="{{ __('Company Name') }}" />
                <x-jet-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" required autofocus />
            </div>

            <div>
                <x-jet-label for="sales_office" value="{{ __('Sales Office') }}" />
                <x-jet-input id="sales_office" class="block mt-1 w-full" type="text" name="sales_office" />
            </div>

            <div>
                <x-jet-label for="phone" value="{{ __('Phone') }}" />
                <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" required autofocus />
            </div>

            <input type="hidden" name="count" value="{{$reservation['count']}}">
            <input type="hidden" name="reservation_date" value="{{$reservation['reservation_date']}}">


            <button class="btn btn-primary">登録</button>

        </form>
    </x-jet-authentication-card>
</x-guest-layout>
