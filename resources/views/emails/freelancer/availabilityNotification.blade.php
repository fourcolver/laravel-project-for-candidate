@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ str_replace(' ', '&nbsp;', config('app.name')) }}
        @endcomponent
    @endslot

    {{-- Body --}}
    # Availability request

    Hello, {{$user->title}} {{$user->last_name}}!
    We saw that you will be available soon again.
    Are you open to new project or are you expecting an extension?
    We would like to here from you!

    Thanks,
    {{ config('app.name') }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent