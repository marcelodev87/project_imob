@component('mail::message')
    # Novo Contato
    <p> Contato: {{ $name }} <{{ $email }}></p>
    <p>Telefone: {{ $cell }}</p>
    <p>Messagem:</p>
    <p>{{ $message }}</p>
@endcomponent
