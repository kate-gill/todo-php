<?php include('db.php') ?>

<!DOCTYPE html>
<html>
<head>
    <title>Todo List</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Yeseva+One&display=swap" rel="stylesheet">
</head>
<body>
    <h1>My Todo List</h1>
    <form method="POST" action="index.php">
        <input type="hidden" name="id" value="<?php echo $id ?>"/>
        <input type="text" name="task" value="<?php echo $task ?>" placeholder="Type your todo in here..."/>

        <?php if(!$editing){?>
            <button class="btn" type="submit" name="add"><i class='fas fa-plus'></i></button>
        <?php } else {?>            
            <button class="btn" type="submit" name="update"><i class='fas fa-check'></i></button>
            <button class="btn" name="cancel"><i class='fas fa-times'></i></button>
        <?php } ?>
    </form>

    <?php if($error){?>
        <p><?php echo $error?></p>
    <?php } ?>

    <table id="main">
        <tr class="tableTop">
            <th>&#8470;</th>
            <th>Task</th>
            <th colspan="2">Action</th>
        </tr>

        <?php
        $sql = "SELECT * FROM tasks";
        $results = mysqli_query($connection, $sql);

        $i = 1; while($row = mysqli_fetch_array($results)){ ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row['task']?></td>
            <td><a href="index.php?edit=<?php echo $row['id']?>" name="edit"><button class="btnAction"><i class="fas fa-pencil-alt"></i></button></a></td>
            <td><a href="index.php?delete=<?php echo $row['id']?>" name="delete"><button class="btnAction"><i class="far fa-trash-alt"></i></button></a></td>
        <tr>
        <?php $i++; } ?>

    </table>

    <script src="https://kit.fontawesome.com/78ed2231e4.js"></script>
</body>
</html>