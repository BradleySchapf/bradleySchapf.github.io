<?php

/*******w******** 
    
    Name:
    Date:
    Description:

****************/
   
require("connect.php");

if (isset($_GET['Title'])) { // Retrieve quote to be edited, if id GET parameter is in URL.
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
    <h1><?php echo $blog["Title"] ?> </h1>
    <p><?php echo $blog["Content"] ?> </h1>           
    <a href="index.php">Back to Blog</a>
    </div>
    </div>
</body>
</html>