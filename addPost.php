<?php

require 'classes/databases.php';

$database = new Database;

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
//$database->query('SELECT * FROM posts');


if(@$_POST['delete']){

    $delete_id =$_POST['delete_id'];
    $database->query('DELETE FROM blog_posts WHERE id = :id');
    $database->bind(':id', $delete_id);
    $database->execute();
}

if(@$post['update']){

    $id= $post['id'];
    $title = $post['title'];
    $post = $post['post'];


    $database->query('UPDATE blog_posts SET title = :title, post = :post WHERE id = :id');
    $database->bind(':title', $title);
    $database->bind(':post', $post);
    $database->bind(':id', $id);
    $database->execute();
}



if(@$post['submit']){

    $title = $post['title'];
    $post = $post['post'];



    $database->query('INSERT INTO blog_posts (title, post) VALUES(:title, :post)');
    $database->bind(':title', $title);
    $database->bind(':post', $post);
    $database->execute();

    if($database->lastInsertID()){

        echo'<p>Post Added!</p>';
    }

}

$database->query('SELECT * FROM blog_posts');
$rows = $database->resultset();

?>
<head>
    <title>
        MY BLOG! | TITLE GOES HERE!
    </title>

    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="addPost.php">Add Post</a></li>
        <li><a href="about.html">About</a></li>
        <li style="float:right"><a href="profile.php">Profile</a></li>
    </ul>
</nav>
<br />

<div class="container" style="margin:0 auto;">

    <div class="holder">

        <h1 id="addPost">Add a Post</h1>

        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

            <label>Title</label><br />

            <input type="text" name="title" placeholder="Title" /><br /><br />

            <label>Post</label><br />

            <textarea name="post"></textarea><br /><br />

            <input type="submit" name="submit" value="Submit" placeholder="What is your amazing idea?.."/>

        </form>

    </div>




</div>