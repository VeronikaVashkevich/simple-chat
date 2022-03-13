@foreach($messages as $message)
<div class="message">
    <div class="name">{{ $message->name }}</div>
    <div class="mes-text">{{ $message->text }}</div>
</div>
@endforeach
