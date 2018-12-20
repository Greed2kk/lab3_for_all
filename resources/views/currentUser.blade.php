<!DOCTYPE html>
<html>
    <head>
        <title>User: {{$user_name}}</title>
    </head>
    <body>
          
        <h1>Пользователь {{$user_name}} и Этап: {{ isset($curent_user_stage_now) ? $curent_user_stage_now : 'Вы ответили на всех ваших этапах!' }} </h1>
       
        <h1>Сейчас этап:{{ isset($curent_user_stage) ? $curent_user_stage : 'Все этапы закончились!' }}
</h1>

        
        @if (($curent_user_stage == $curent_user_stage_now) and (isset($curent_user_stage_now)))
         <form method="post" id="add_inf_u" action="{{ route('add')}}" aria-label="{{ __('add') }}" >
            {{ csrf_field() }}
              <input type="hidden" name="user_name" value="{{ $user_name}}" />
              <input type="hidden" name="curent_user_stage_now" value="{{ $curent_user_stage_now }}" />
              <input type="hidden" name="curent_user_stage" value="{{ $curent_user_stage}}"    
  
            <p><b>Ваш ответ:</b></p>
            <p><input name="choice" type="radio" value=1 id="userChoice1" onChange="this.form.submit()"> Одобрено </p>
            <p><input name="choice" type="radio" value=0 id="userChoice2" onChange="this.form.submit()"> Не одобрено </p>
           <!-- <p><input type="submit" value="Отправить"></p> -->
        </form>
 <input value="Выбор пользователя" type="button" onclick="location.href='http://localhost/users'" />
        @else
         <h1>Подождите очереди.</h1>
          <input value="Выбор пользователя" type="button" onclick="location.href='http://localhost/users'" />
         @endif 
         
        
        
    </body>
</html>



