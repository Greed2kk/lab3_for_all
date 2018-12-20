<!DOCTYPE html>
<html>
    <head>
        <title>Upload File</title>
    </head>
    <body>
        <h1>Загрузка json-файла</h1>
        <form method="post" action="{{ route('uploads_file') }}" enctype="multipart/form-data">
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
            <input type="file" multiple name="file[]">
            <button type="submit" value = "add_inf">Записать</button>
        </form>
    </body>
</html>