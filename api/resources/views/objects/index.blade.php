<!DOCTYPE html>
<html>
<head>
    <title>Lista de Obras de Arte</title>
</head>
<body>
    <h1>Lista de Títulos de Obras de Arte</h1>
    <ul>
        @foreach ($titlesWithArtists as $titleWithArtist)
            <li>{{ $titleWithArtist }}</li>
        @endforeach
    </ul>
</body>
</html>
