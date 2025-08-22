<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Todos</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <h1>Mes Todos</h1>
        <ul>
            @forelse($todos as $todo)
                <li>
                    <strong>{{ $todo->title }}</strong>
                        @if($todo->is_done) ✅ @else ⏳ @endif
                    <div>{{ $todo->description }}</div>
                </li>
            @empty
                <li>Aucun todo.</li>
            @endforelse
        </ul>
    </body>
</html>
