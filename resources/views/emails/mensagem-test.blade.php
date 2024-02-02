@component('mail::message')
# Introdução do email

Olá,

@component('mail::button', ['url' => ''])
Não clique aqui
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
