<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script language="javascript">
        let currentId = 0
        function deleteTodo(event) {
            let id = event.target.getAttribute("data-id");
            axios.post("todos/delete", {"id": id,})
            window.location.reload();
        }

        function openUpdateForm(event) {
            event.preventDefault();
            let button = $(event.target);
            let f = button.siblings("form");
            f.removeAttr("hidden")
        }

        function updateTodo(e) {
            e.preventDefault();
            let value = $(e.target).children("input").val()
            let id  = $(e.target).prev().prev().attr("data-id")
            axios.post("todos/update", {"id": id, "tache":value,})
            window.location.reload();
        }

    </script>
 <body>

     <form method="POST" action="{{route("todos.create")}}">
         {{csrf_field()}}
         <label for="tache">Tache</label> </br>
         <input type="text" name="tache">
         <button type="submit">Ajouter</button>
     </form>

     <ul>
         @if(!!count($todos))
             @foreach($todos as $todo)
                 <li data-id="{{$todo->id}}"
                     style="cursor: pointer;display:inline-block"
                     onclick="deleteTodo(event)">

                     {{$todo->tache ?? 'no list'}}

                 </li>
                 <button onclick="openUpdateForm(event)">Maj</button>
                 <form hidden onsubmit="updateTodo(event)">
                     <input type="text" name="tache">
                     <button type="submit">Submit</button>
                 </form>
                 <br>
             @endforeach
         @else
             <div class="">la liste est vide</div>
         @endif

     </ul>
 </body>
</html>
