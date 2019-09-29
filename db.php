<?php

$serverName = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'todos';

$connection = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

$id = 0;
$task = "";
$editing = false;
$error = "";

if(isset($_POST['add'])){
    if(empty($_POST['task'])){
        $error = "Can't be empty!";
    } else {
        $task = mysqli_real_escape_string($connection, $_POST['task']);
        $sql = "INSERT INTO tasks (task) VALUES ('$task');";
        mysqli_query($connection, $sql);
        header('Location: index.php');
    }
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql = "DELETE FROM tasks WHERE id='$id';";
    mysqli_query($connection, $sql);
    header('Location: index.php');
}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $sql = "SELECT * FROM tasks WHERE id='$id';";
    $result = mysqli_query($connection, $sql);
    $editing = true;

    if($result){
        $tasks = mysqli_fetch_array($result);
        $task = $tasks['task'];
    }
}

if(isset($_POST['update'])){
    if(empty($_POST['task'])){
        $error = "Can't be empty!";
    } else {
        $id = $_POST['id'];
        $task = mysqli_real_escape_string($connection, $_POST['task']);
        $sql = "UPDATE tasks SET task='$task' WHERE id='$id';";
        mysqli_query($connection, $sql);
        header('Location: index.php');
    }
}

if(isset($_POST['cancel'])){
    header('Location: index.php');
}

