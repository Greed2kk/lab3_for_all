<!DOCTYPE html>
<html>
    <head>
        <title>output</title>


    </head>
    <body>
        <div class="container" >

            <table border="1">
                <caption>Все пользователи и их ответы</caption>
                <tr>
                    <th>Id</th><th>Этап</th><th>Пользователь</th><th>Ответ</th>
                </tr>
                @foreach ($total_inf as $total_infs)
                <tr>
                    <td>{{ $total_infs->id }}</td><td>{{ $total_infs->stage }}</td><td>{{ $total_infs->user_name }}</td><td>{{ $total_infs->answer }}</td>   
                </tr>
                @endforeach
            </table>
<h2>Скачать в .json</h2>
<input type="submit" value="Скачать" onclick=" location.href ='{{ url('/download-jsonfile') }}'  ">
<br>
            <table border="1">
                <caption>Ответы по всем этапам</caption>
                <tr>
                    <th>Id</th><th>Этап</th><th>Ответ</th></th
                </tr>
                @foreach ($stage_res as $stage_ress)
                <tr>
                    <td>{{ $stage_ress->id }}</td><td>{{ $stage_ress->stage }}</td><td>{{ $stage_ress->answer }}</td> 
                </tr>
                @endforeach
            </table>
<h1>Результат по всем этапам:{{$stage_res_res}}<h1>
<h2>Скачать в .json</h2>
<input type="submit" value="Скачать" onclick=" location.href ='{{ url('/download-jsonfile-1') }}'  ">
<br>
</body>
</html>