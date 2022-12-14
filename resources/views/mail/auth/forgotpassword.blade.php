@component('mail::message')
<h1 class="block font-bold text-2xl mb-4">Etto Store</h1>
<p class="mb-8">Someone (hopefully you) has requested a password reset for your Heroku account. Follow the link below to set a new password:</p>
<a class="block mb-8" href="{{$url}}">{{ $url }}</a>
<br>
<p>If you don't wish to reset your password, disregard this email and no action will be taken.</p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent