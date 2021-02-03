@component('mail::message')
# Support Mail
Dear Admin,<br>
{{$name}} has contacted you.
<br>
About - {{$title}}
@component('mail::panel')
    {{$content}}
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
