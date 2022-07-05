@component('mail::message')

        {{ config('app.name') }}

        {{$subject}}

        {{$message}}

        You can reach me via mail: {{$email}}

        Thanks,
        {{$fullname}}

@endcomponent
