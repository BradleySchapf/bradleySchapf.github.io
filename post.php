<?php

/*******w******** 
    
    Name:
    Date:
    Description:

****************/

require('connect.php');
// require('authenticate.php')

if ($_POST && !empty($_POST['title']) && !empty($_POST['content'])) {
    //  Sanitize user input to escape HTML entities and filter out dangerous characters.
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    //  Build the parameterized SQL query and bind to the above sanitized values.
    $query = "INSERT INTO blog (title, content) VALUES (:title, :content)";
    $statement = $db->prepare($query);
    
    //  Bind values to the parameters
    $statement->bindValue(':title', $title);
    $statement->bindValue(':content', $content);
    
    //  Execute the INSERT.
    if($statement->execute()) {
        header('Location: ' . 'index.php');
        exit();
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>My Blog Post!</title>
</head>
<body>
    <div class="container">
    <div class="vertical">
    <h1>Post to the Bradley Blog</h1>
        <form class="vertical" action="post.php" method="post">
            <div class="horizontal">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title">
            </div>
            <label for="content">Content:</label>
            <textarea name="content" id="content" cols="30" rows="10"></textarea>
            <input type="submit" value="Post">
        </form>
    <a href="index.php">Back to Blog</a>
    </div>
    </div>
</body>
</html>