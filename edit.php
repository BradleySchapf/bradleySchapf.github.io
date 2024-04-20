<?php

/*******w******** 
    
    Name:
    Date:
    Description:

****************/

require('connect.php');
// require('authenticate.php')


if ($_POST && isset($_POST['Title']) && isset($_POST['Content'])) {
    // Sanitize user input to escape HTML entities and filter out dangerous characters.
    $title  = filter_input(INPUT_POST, 'Title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'Content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    // Build the parameterized SQL query and bind to the above sanitized values.
    $query     = "UPDATE blog SET Title = :Title, Content = :Content WHERE Title = :Title";
    $statement = $db->prepare($query);
    $statement->bindValue(':Title', $title);        
    $statement->bindValue(':Content', $content);
    
    // Execute the INSERT.
    $statement->execute();
    
    // Redirect after update.
    header("Location: index.php");
    exit;
} else if (isset($_GET['Title'])) { // Retrieve quote to be edited, if id GET parameter is in URL.
    // Sanitize the id. Like above but this time from INPUT_GET.
    
    // Build the parametrized SQL query using the filtered id.
    $query = "SELECT Title, Content FROM blog WHERE Title = :Title";
    $statement = $db->prepare($query);
    $statement->bindValue(':Title', $_GET['Title'], PDO::PARAM_STR);
    //$statement->bindValue(':Content', "I am making this post straight from the website! how cool is that.", PDO::PARAM_STR);
    
    // Execute the SELECT and fetch the single row returned.
    $statement->execute();
    $blog = $statement->fetch(PDO::FETCH_ASSOC);
}
else {
    echo "something went wrong....";
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
    <h1>Edit post on the Bradley Blog</h1>
        <form class="vertical" method="post">
            <div class="horizontal">
            <label for="Title">Title:</label>
            <input type="text" name="Title" id="Title" value="<?php echo ($blog['Title']); ?>">
            </div>
            <label for="Content">Content:</label>
            <textarea name="Content" id="Content" cols="50" rows="10"><?php echo ($blog['Content']); ?></textarea>
            <input type="submit" value="Save Post">
        </form>
    <a href="index.php">Back to Blog</a>
    </div>
    </div>
</body>
</html>