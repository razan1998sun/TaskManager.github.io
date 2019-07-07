<?php 
require "App/config.php"; 

$user_id = $_SESSION['user_id'];
$result = $connection->query("SELECT id ,description ,done , due_date FROM tasks WHERE user_id = $user_id ");
$tasks = $result->num_rows > 0 ? $result : []; 
?>
<html>
<head> 
<title>Task Manager Assistant </title>
<link rel="stylesheet" href="Css/index.css"/>
</head>
<body>
<div class="container">
<h1 class="header"> My Tasks </h1>
<!-- نختبر اذا لم يكن هناك اية مهام -->
<?php if (empty($tasks)): ?>
<p>There is no tasks. </p>
<?php else:?>
<ul class="tasks">
    <!-- اذا كان هناك مهام..فسنكرر طباعتها هنا -->
<?php foreach($tasks as $task ):?>

<li> 
<span class="task <?php echo $task['done'] ? 'done' : '' ?>"><?php echo $task['description'];?> </span> 

<?php if ($task['done']):?>
<button><a class="done-buttin" href="App/delete.php?task_id=<?php echo $task['id']?>">DELETE</a></button>
<?php else:?> 
 <button><a class="done-button" href="App/mark.php?task_id=<?php echo $task['id']?>"> DONE </a> </button>
<?php endif;?>
<?php $task['due_date']= strtotime($task['due_date'])?>
<p class="date"> Last date to complete the task:
     <?php echo date('Y-m-d',$task['due_date']) ?> </p>
</li>
<?php endforeach;?>
</ul>
<?php endif;?>

<?php 
 if ( isset($_SESSION['errors']) ) {
foreach ($_SESSION['errors'] as $error){
 echo "<p  style=\"color:red;font-size:20px;\">$error</p>" ; }
$_SESSION['errors'] = []; }
?>

<form class="task-add" action="App/add.php" method="POST">
<input type="text" speceholder="Add a task!" class="input"  name="task_name"/> <br>
<input type="text" speceholder="Date to complete the task"  class="input" name="due_date" /> <br> 
<input type="submit" value="submit" class="submit"/>
</form>
</div>

</body>
</html>