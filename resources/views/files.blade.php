<!DOCTYPE html>
<html>
    <head>
        <title>Upload File</title>
    </head>
    <body>
        <table>
            @if($files)
            <thead>
            <th>Название</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($files as $file)
            <tr>
                <td>{{ $file }}</td>
                <td><a href="{{ route('uploads_delete',['filename' => $file]) }}">Удалить</a></td>
                <td><a href="{{ route('uploads_open',['filename' => $file]) }}">Открыть</a></td>
            </tr>
            @endforeach
        </tbody>
        @else
        <tr>
            <td colspan="2">Файлов нет</td>
        </tr>
        @endif
    </table>
</body>
</html>