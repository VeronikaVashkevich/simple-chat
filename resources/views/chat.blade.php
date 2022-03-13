<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Chat</title>
</head>
<body>
<header>
    <div class="title">
        <h1>Simple Chat App</h1>
    </div>
</header>
<div class="container">
    <div class="chat">
        <div class="messages">
            @foreach($messages as $message)
                <div class="message">
                    <div class="name">{{ $message->name }}</div>
                    <div class="mes-text">{{ $message->text }}</div>
                </div>
            @endforeach
        </div>
        <div class="form">
            <form method="post" class="form">
                @csrf
                <input type="text" name="name" id="name" class="form-control" placeholder="Your name">
                <textarea name="text" id="text" maxlength="1000" placeholder="Your message"></textarea>
                <button class="btn-submit">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.btn-submit').click(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route('chat') }}',
                method: 'post',
                data: {
                    'name' : $('#name').val(),
                    'text' : $('#text').val(),
                    'getMes' : 'false',
                },
                success: (data) => {
                    $('.messages').html(data)
                }
            })
        });

        setInterval(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route('chat') }}',
                method: 'get',
                data: {
                    'getMes' : 'true',
                },
                success: (data) => {
                    $('.messages').html(data)
                }
            })
        }, 1000)
    })
</script>

</body>
</html>
