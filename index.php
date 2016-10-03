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

<div class="container">


<h1 id="posts" style="margin-left:5%;">Posts</h1>

        <div>

            <?php foreach($rows as $row) : ?>

                        <div>

                                <h3 style="margin-left:13%;"> <?php echo $row['title']; ?></h3>

                            <p style="margin-left:15%;"> <?php echo $row['post']; ?></p>

                        </div>

                <br />


                    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" ">

                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>" />

                        <button class="button" type="submit" name="delete" value="Delete" >Delete</button>

                    </form>

                

            </div>

            <?php endforeach; ?>

        </div>



</div>