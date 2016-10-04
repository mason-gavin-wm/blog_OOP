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

        echo'<p>Click<a href="index.php">Here!</a> To see your post</p>';
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
        <li><a href="aboutus.html">About</a></li>
        <li style="float:right"><a href="profile.php">Profile</a></li>
    </ul>
</nav>
<br />

<div class="container" >

    <div style="border: 3px dashed #873f44; width:22%; height:50%; margin-left: 1090px; position:fixed;">

        <h3 style="text-align: center;">What is Lorem Ipsum?</h3>

        <p style=" margin-left:4px;">&nbsp;&nbsp;&nbsp;Lorem Ipsum is simply dummy text of the printing and typesetting industry.
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
        </p>
        <p style=" margin-left:4px;">
            &nbsp;&nbsp;&nbsp;When an unknown printer took a galley of type and scrambled it to make a type
            specimen book.
        </p>


    </div>


<h1 id="posts" style="margin-left:5%; font-size:46px;">Blog Posts</h1>

        <div>


            <?php foreach($rows as $row) : ?><br />

                        <div id="post_container" style="border-radius: 3px;border: 4px solid rgba(48, 113, 211, 0.98);">


                            <h3 style="position: absolute; margin-left:5px;">Title:</h3>

                                    <h3 style="margin-left:5%; position: absolute"> <?php echo $row['title']; ?></h3>
                            <br />

                                    <p style="margin-left:15%;">&nbsp;&nbsp;&nbsp; <?php echo $row['post']; ?></p>

                                <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

                                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>"/>

                                    <button class="button" type="submit" name="delete" value="Delete">Delete</button>

                        </div>
    
                <br /><br />

            <hr>

            </div>

            <?php endforeach; ?>

        </div>





