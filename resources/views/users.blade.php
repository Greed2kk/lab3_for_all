<!DOCTYPE html>
<html>
    <head>
        <title>Users</title>
    </head>
    <body>
        <h1>Всего пользователей:{{$users}}</h1>
        <h1>Всего этапов: {{$total_stage}}</h1>
        <h1>Сейчас этап: {{ isset($current_stage) ? $current_stage : 'Все этапы закончились !' }} </h1> 
        @if (is_null($current_stage))
        <input type="submit" value="Отчет" onclick=" location.href ='{{ url('/output') }}'  ">
         <br>
        @endif
       
        @foreach ($users_name as $users_names) 
        <br>
        <a href="{{route('user', ['user_name' => $users_names->name])}}">Пользователь: {{$users_names->name}}</a>
        <br>


        @endforeach
        <br>





    </body>
</html>
