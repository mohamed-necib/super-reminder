<?php
session_start();
require_once './Class/Task.php';

//Fin d'une tâche via la classe Task:
if(isset($_POST["finishTask"])){
    $id = $_POST["id"];
    $task = new Task();
    echo $task->finishTask($id);
}

//Suppression d'une tâche via la classe Task:
if(isset($_POST["deleteTask"])){
    $id = $_POST["id"];
    $task = new Task();
    echo $task->deleteTask($id);
}

//Récupération des tâches via la classe Task:
if(isset($_GET["getTasks"])){
    $user_id = $_SESSION["user"]->id;
    $task = new Task();
    $datas = $task->getTasks($user_id);
    echo json_encode($datas);
}

//Création d'une tâche via la classe Task:
if(isset($_POST["createTask"])){
    require_once './Class/Task.php';
    $title = $_POST["title"];
    $description = $_POST["description"];
    $user_id = $_SESSION["user"]->id;
    $task = new Task();
    echo $task->createTask($title, $description, $user_id);
}