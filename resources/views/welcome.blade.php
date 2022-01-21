<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>


    </head>
 <body>

     <form method="POST" action="{{route("todos.create")}}">
         {{csrf_field()}}
         <label for="tache">Tache</label> </br>
         <input type="text" name="tache">
         <button>Ajouter</button>
     </form>

     <ul>
         @if(!!count($todos))
             @foreach($todos as $todo)
                 <li>{{$todo->tache ?? 'no list'}}</li>
             @endforeach
         @else
             <div class="">la liste est vide</div>
         @endif

     </ul>
 </body>
</html>
