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
<h1>Add Post</h1>

        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

            <label>Post ID</label><br />

                <input type="text" name="id" placeholder="Specify ID"/> <br /> <br />

            <label>Post Title</label><br />

                <input type="text" name="title" placeholder="Add a Title..." /><br /><br />

            <label>Post Body</label><br />

                <textarea name="post"></textarea><br /><br />

            <input type="submit" name="submit" value="Submit" />

        </form>


<h1>Posts</h1>

        <div>

            <?php foreach($rows as $row) : ?>

            <div>

                <h3> <?php echo $row['title']; ?></h3>

                <p> <?php echo $row['post']; ?></p>

                <br />

                    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?> ">

                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>" />

                        <input type="submit" name="delete" value="Delete" />

                    </form>

            </div>

            <?php endforeach; ?>

        </div>