<?php

/*******w******** 
    
    Name:
    Date:
    Description:

****************/

require('connect.php');

$query = "SELECT * FROM blog ORDER BY datetimestamp DESC";
$statement = $db->prepare($query);
$statement->execute();

$count = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Welcome to my Blog!</title>
</head>
<body>
    <div class="container">
    <h1>The Bradley Blog</h1>
    <a href="post.php">New blog post</a>
    <a href="index.php">Homepage</a>
    <h4>Recently Posted:</h4>
    <?php while (($row = $statement->fetch()) && $count < 5): ?>
        <div class="postTitle">
        <h3><?= $row['Title'] ?></h3>
        
        <h6><a href="edit.php?Title=<?= $row['Title'] ?>">Edit</a></h6>
        </div>
        <h5><?= $row['datetimestamp'] ?></h5>
        
        <p><?= $row['Content'] ?></p>
        <a href="fullarticle.php?Title=<?= $row['Title'] ?>">Read full article</a>
        <?php $count++; ?>
    <?php endwhile ?>
    <?php $count = 0; ?>
    </div>
</body>
</html>