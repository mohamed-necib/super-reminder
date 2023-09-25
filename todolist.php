<h1>Todo List</h1>

<form method="post" id="formTask">
  <input type="text" name="task" placeholder="Tâche" required />
  <input type="submit" value="Ajouter" />
</form>

<div class="displayTodos">
  <ul id="todos">
    
   <!-- foreach ($todos as $todo) {
      echo "<li id='" . $todo->id . "'><span>" . $todo->task . "</span><button class='delete'>X</button></li>";
    } -->
  </ul>
  
</div>